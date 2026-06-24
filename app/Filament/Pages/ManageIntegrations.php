<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use App\Services\TelegramNotifier;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

/**
 * @property-read \Filament\Schemas\Schema $form
 */
class ManageIntegrations extends Page
{
    protected string $view = 'filament.pages.manage-integrations';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    protected static ?string $navigationLabel = 'الإعدادات والتكاملات';

    protected static ?string $title = 'الإعدادات والتكاملات';

    protected static ?int $navigationSort = 9;

    /** @var array<string, mixed> */
    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'telegram_enabled'   => (bool) Setting::get('telegram_enabled', false),
            'telegram_bot_token' => Setting::get('telegram_bot_token'),
            'telegram_chat_id'   => Setting::get('telegram_chat_id'),
            'whatsapp_number'    => Setting::get('whatsapp_number', config('site.contact.whatsapp')),
            'notification_email' => Setting::get('notification_email', config('site.contact.email')),
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('إشعارات تيليجرام')
                    ->description('استقبل تنبيهاً فورياً على تيليجرام عند وصول طلب مشروع أو رسالة تواصل جديدة.')
                    ->icon('heroicon-o-paper-airplane')
                    ->schema([
                        Toggle::make('telegram_enabled')
                            ->label('تفعيل إشعارات تيليجرام'),
                        TextInput::make('telegram_bot_token')
                            ->label('توكن البوت (Bot Token)')
                            ->helperText('أنشئ بوتاً عبر @BotFather في تيليجرام واحصل على التوكن.')
                            ->password()
                            ->revealable(),
                        TextInput::make('telegram_chat_id')
                            ->label('معرّف المحادثة (Chat ID)')
                            ->helperText('معرّف حسابك أو مجموعتك. استخدم @userinfobot لمعرفته.'),
                    ])
                    ->columns(1),

                Section::make('واتساب')
                    ->description('الرقم المستخدم في أزرار التواصل عبر واتساب (روابط wa.me) في الموقع ولوحة التحكم.')
                    ->icon('heroicon-o-chat-bubble-left-right')
                    ->schema([
                        TextInput::make('whatsapp_number')
                            ->label('رقم الواتساب (صيغة دولية بدون +)')
                            ->placeholder('9665XXXXXXXX')
                            ->helperText('مثال: 966500000000'),
                    ]),

                Section::make('البريد')
                    ->icon('heroicon-o-envelope')
                    ->schema([
                        TextInput::make('notification_email')
                            ->label('بريد استقبال الإشعارات')
                            ->email()
                            ->helperText('يصل إليه إشعار الطلبات ورسائل التواصل.'),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        Setting::putMany([
            'telegram_enabled'   => ! empty($data['telegram_enabled']) ? '1' : '0',
            'telegram_bot_token' => $data['telegram_bot_token'] ?? '',
            'telegram_chat_id'   => $data['telegram_chat_id'] ?? '',
            'whatsapp_number'    => preg_replace('/\D+/', '', (string) ($data['whatsapp_number'] ?? '')),
            'notification_email' => $data['notification_email'] ?? '',
        ]);

        Notification::make()->title('تم حفظ الإعدادات بنجاح')->success()->send();
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('testTelegram')
                ->label('إرسال رسالة تجريبية')
                ->icon('heroicon-o-paper-airplane')
                ->color('gray')
                ->action(function (TelegramNotifier $telegram) {
                    // Persist current form values first so the test uses them.
                    $this->save();

                    $ok = $telegram->send("✅ <b>اختبار اتصال</b>\nتم ربط تيليجرام بموقع إتقان بنجاح.");

                    if ($ok) {
                        Notification::make()->title('تم إرسال رسالة الاختبار بنجاح')->success()->send();
                    } else {
                        Notification::make()
                            ->title('تعذّر الإرسال')
                            ->body('تأكد من تفعيل الإشعارات وصحة التوكن ومعرّف المحادثة.')
                            ->danger()
                            ->send();
                    }
                }),
        ];
    }
}
