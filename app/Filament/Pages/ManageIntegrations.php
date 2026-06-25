<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use App\Services\TelegramNotifier;
use App\Support\Settings;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Mail;

/**
 * @property-read \Filament\Schemas\Schema $form
 */
class ManageIntegrations extends Page
{
    protected string $view = 'filament.pages.manage-integrations';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    protected static ?string $navigationLabel = 'الإعدادات والتكاملات';

    protected static ?string $title = 'الإعدادات والتكاملات';

    protected static string|\UnitEnum|null $navigationGroup = 'الإعدادات';

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
            'mail_host'          => Setting::get('mail_host'),
            'mail_port'          => Setting::get('mail_port', '587'),
            'mail_username'      => Setting::get('mail_username'),
            'mail_password'      => Setting::get('mail_password'),
            'mail_encryption'    => Setting::get('mail_encryption', 'tls'),
            'mail_from_address'  => Setting::get('mail_from_address', config('mail.from.address')),
            'mail_from_name'     => Setting::get('mail_from_name', config('app.name')),

            'site_logo'          => Setting::get('site_logo'),
            'site_logo_white'    => Setting::get('site_logo_white'),
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
                        Toggle::make('telegram_enabled')->label('تفعيل إشعارات تيليجرام'),
                        TextInput::make('telegram_bot_token')
                            ->label('توكن البوت (Bot Token)')
                            ->helperText('أنشئ بوتاً عبر @BotFather في تيليجرام واحصل على التوكن.')
                            ->password()->revealable(),
                        TextInput::make('telegram_chat_id')
                            ->label('معرّف المحادثة (Chat ID)')
                            ->helperText('معرّف حسابك أو مجموعتك. استخدم @userinfobot لمعرفته.'),
                    ])->columns(1),

                Section::make('واتساب')
                    ->description('الرقم المستخدم في أزرار التواصل عبر واتساب (روابط wa.me) في الموقع ولوحة التحكم.')
                    ->icon('heroicon-o-chat-bubble-left-right')
                    ->schema([
                        TextInput::make('whatsapp_number')
                            ->label('رقم الواتساب (صيغة دولية بدون +)')
                            ->placeholder('9665XXXXXXXX')
                            ->helperText('مثال: 966500000000'),
                    ]),

                Section::make('البريد الإلكتروني (SMTP)')
                    ->description('إعدادات إرسال البريد. تُستخدم لإرسال إشعارات الطلبات ورسائل التواصل.')
                    ->icon('heroicon-o-envelope')
                    ->schema([
                        TextInput::make('notification_email')
                            ->label('بريد استقبال الإشعارات')->email()
                            ->helperText('يصل إليه إشعار الطلبات ورسائل التواصل.')
                            ->columnSpanFull(),
                        TextInput::make('mail_host')->label('خادم SMTP (Host)')->placeholder('smtp.example.com'),
                        TextInput::make('mail_port')->label('المنفذ (Port)')->numeric()->placeholder('587'),
                        TextInput::make('mail_username')->label('اسم المستخدم'),
                        TextInput::make('mail_password')->label('كلمة المرور')->password()->revealable(),
                        Select::make('mail_encryption')
                            ->label('التشفير')
                            ->options(['tls' => 'TLS (المنفذ 587)', 'ssl' => 'SSL (المنفذ 465)', '' => 'بدون']),
                        TextInput::make('mail_from_address')->label('بريد المرسِل')->email()->placeholder('noreply@itqaanit.com'),
                        TextInput::make('mail_from_name')->label('اسم المرسِل')->placeholder('إتقان'),
                    ])->columns(2),

                Section::make('الشعار والهوية')
                    ->description('استبدل شعار الموقع. اترك الحقل فارغاً لاستخدام الشعار الافتراضي المدمج.')
                    ->icon('heroicon-o-photo')
                    ->schema([
                        FileUpload::make('site_logo')
                            ->label('الشعار (للخلفيات الفاتحة)')
                            ->helperText('يظهر في الشريط العلوي. PNG / SVG / WEBP مفضّلة.')
                            ->image()
                            ->disk('public')->directory('branding')->visibility('public')
                            ->maxSize(2048),
                        FileUpload::make('site_logo_white')
                            ->label('الشعار الأبيض (للخلفيات الداكنة)')
                            ->helperText('يظهر في تذييل الموقع (الخلفية الداكنة).')
                            ->image()
                            ->disk('public')->directory('branding')->visibility('public')
                            ->maxSize(2048),
                    ])->columns(2),
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
            'mail_host'          => $data['mail_host'] ?? '',
            'mail_port'          => $data['mail_port'] ?? '',
            'mail_username'      => $data['mail_username'] ?? '',
            'mail_password'      => $data['mail_password'] ?? '',
            'mail_encryption'    => $data['mail_encryption'] ?? '',
            'mail_from_address'  => $data['mail_from_address'] ?? '',
            'mail_from_name'     => $data['mail_from_name'] ?? '',

            'site_logo'          => $data['site_logo'] ?? '',
            'site_logo_white'    => $data['site_logo_white'] ?? '',
        ]);

        Notification::make()->title('تم حفظ الإعدادات بنجاح')->success()->send();
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('testTelegram')
                ->label('اختبار تيليجرام')
                ->icon('heroicon-o-paper-airplane')
                ->color('gray')
                ->action(function (TelegramNotifier $telegram) {
                    $this->save();
                    $ok = $telegram->send("✅ <b>اختبار اتصال</b>\nتم ربط تيليجرام بموقع إتقان بنجاح.");
                    $ok
                        ? Notification::make()->title('تم إرسال رسالة الاختبار بنجاح')->success()->send()
                        : Notification::make()->title('تعذّر الإرسال')->body('تأكد من تفعيل الإشعارات وصحة التوكن ومعرّف المحادثة.')->danger()->send();
                }),

            Action::make('testEmail')
                ->label('اختبار البريد')
                ->icon('heroicon-o-envelope')
                ->color('gray')
                ->action(function () {
                    $this->save();
                    Settings::applyMailConfig();
                    try {
                        Mail::raw('هذه رسالة اختبار من لوحة تحكم موقع إتقان. تم ضبط إعدادات البريد بنجاح.', function ($m) {
                            $m->to(Settings::notificationEmail())->subject('اختبار إعدادات البريد — إتقان');
                        });
                        Notification::make()->title('تم إرسال بريد الاختبار')->body('تحقق من صندوق ' . Settings::notificationEmail())->success()->send();
                    } catch (\Throwable $e) {
                        Notification::make()->title('فشل إرسال البريد')->body($e->getMessage())->danger()->send();
                    }
                }),
        ];
    }
}
