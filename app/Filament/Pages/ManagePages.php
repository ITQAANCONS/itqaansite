<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use BackedEnum;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

/**
 * @property-read \Filament\Schemas\Schema $form
 */
class ManagePages extends Page
{
    protected string $view = 'filament.pages.manage-pages';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static string|UnitEnum|null $navigationGroup = 'المحتوى';

    protected static ?string $navigationLabel = 'محتوى الصفحات';

    protected static ?string $title = 'محتوى الصفحات';

    protected static ?int $navigationSort = 5;

    /** @var array<string, mixed> */
    public ?array $data = [];

    /** Editable content fields: key => translation-file fallback key. */
    private const FIELDS = [
        'home_hero_badge'     => 'site.hero.badge',
        'home_hero_title'     => 'site.hero.title',
        'home_hero_highlight' => 'site.hero.title_highlight',
        'home_hero_subtitle'  => 'site.hero.subtitle',
        'home_about_title'    => 'site.about.title',
        'home_about_body'     => 'site.about.body',
        'home_cta_title'      => 'site.cta_section.title',
        'home_cta_subtitle'   => 'site.cta_section.subtitle',
        'home_cta_button'     => 'site.cta_section.button',
    ];

    public function mount(): void
    {
        $state = [];
        foreach (self::FIELDS as $key => $transKey) {
            foreach (['ar', 'en'] as $loc) {
                $state["{$key}_{$loc}"] = Setting::get("{$key}_{$loc}") ?? __($transKey, [], $loc);
            }
        }
        $this->form->fill($state);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('locales')->tabs([
                    Tab::make('العربية')->schema($this->fieldsFor('ar')),
                    Tab::make('English')->schema($this->fieldsFor('en')),
                ])->columnSpanFull(),
            ])
            ->statePath('data');
    }

    private function fieldsFor(string $loc): array
    {
        $dir = $loc === 'ar' ? 'rtl' : 'ltr';

        return [
            Section::make($loc === 'ar' ? 'الواجهة الرئيسية (Hero)' : 'Hero')->schema([
                TextInput::make("home_hero_badge_{$loc}")->label('الشارة')->extraInputAttributes(['dir' => $dir]),
                TextInput::make("home_hero_title_{$loc}")->label('العنوان')->extraInputAttributes(['dir' => $dir]),
                TextInput::make("home_hero_highlight_{$loc}")->label('الجزء المميّز من العنوان')->extraInputAttributes(['dir' => $dir]),
                Textarea::make("home_hero_subtitle_{$loc}")->label('الوصف')->rows(2)->extraInputAttributes(['dir' => $dir]),
            ])->columns(1),

            Section::make($loc === 'ar' ? 'نبذة عنّا' : 'About')->schema([
                TextInput::make("home_about_title_{$loc}")->label('العنوان')->extraInputAttributes(['dir' => $dir]),
                Textarea::make("home_about_body_{$loc}")->label('النص')->rows(4)->extraInputAttributes(['dir' => $dir]),
            ])->columns(1),

            Section::make($loc === 'ar' ? 'دعوة الإجراء (CTA)' : 'Call to action')->schema([
                TextInput::make("home_cta_title_{$loc}")->label('العنوان')->extraInputAttributes(['dir' => $dir]),
                Textarea::make("home_cta_subtitle_{$loc}")->label('الوصف')->rows(2)->extraInputAttributes(['dir' => $dir]),
                TextInput::make("home_cta_button_{$loc}")->label('زر')->extraInputAttributes(['dir' => $dir]),
            ])->columns(1),
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $values = [];
        foreach (self::FIELDS as $key => $transKey) {
            foreach (['ar', 'en'] as $loc) {
                $values["{$key}_{$loc}"] = $data["{$key}_{$loc}"] ?? '';
            }
        }
        Setting::putMany($values);

        Notification::make()->title('تم حفظ محتوى الصفحات')->success()->send();
    }
}
