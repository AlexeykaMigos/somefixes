<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Notifications\Notification;

class ManageSettings extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $view = 'filament.pages.manage-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $settings = Setting::keyValueArray();
        $this->form->fill($settings);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Settings')
                    ->tabs([
                        Tabs\Tab::make('SEO')
                            ->schema([
                                Section::make('Home Page SEO')
                                    ->schema([
                                        TextInput::make('seo_home_title')->label('Title'),
                                        Textarea::make('seo_home_description')->label('Description'),
                                    ]),
                                Section::make('About Page SEO')
                                    ->schema([
                                        TextInput::make('seo_about_title')->label('Title'),
                                        Textarea::make('seo_about_description')->label('Description'),
                                    ]),
                                Section::make('Adoption Page SEO')
                                    ->schema([
                                        TextInput::make('seo_adoption_title')->label('Title'),
                                        Textarea::make('seo_adoption_description')->label('Description'),
                                    ]),
                                Section::make('Blog Page SEO')
                                    ->schema([
                                        TextInput::make('seo_blog_title')->label('Title'),
                                        Textarea::make('seo_blog_description')->label('Description'),
                                    ]),
                                Section::make('Contacts Page SEO')
                                    ->schema([
                                        TextInput::make('seo_contacts_title')->label('Title'),
                                        Textarea::make('seo_contacts_description')->label('Description'),
                                    ]),
                                Section::make('FAQ Page SEO')
                                    ->schema([
                                        TextInput::make('seo_faq_title')->label('Title'),
                                        Textarea::make('seo_faq_description')->label('Description'),
                                    ]),
                                Section::make('Reviews Page SEO')
                                    ->schema([
                                        TextInput::make('seo_reviews_title')->label('Title'),
                                        Textarea::make('seo_reviews_description')->label('Description'),
                                    ]),
                            ]),
                        Tabs\Tab::make('Social Links')
                            ->schema([
                                TextInput::make('social_instagram')->label('Instagram URL')->url(),
                                TextInput::make('social_threads')->label('Threads URL')->url(),
                            ]),
                        Tabs\Tab::make('Contact Info')
                            ->schema([
                                TextInput::make('contact_location')->label('Location'),
                                TextInput::make('contact_working_hours')->label('Working Hours'),
                            ]),
                        Tabs\Tab::make('FAQ')
                            ->schema([
                                Section::make('FAQ Items')
                                    ->schema([
                                        Repeater::make('faq_items')
                                            ->label('Questions')
                                            ->schema([
                                                TextInput::make('question')
                                                    ->label('Question')
                                                    ->required(),
                                                Textarea::make('answer')
                                                    ->label('Answer')
                                                    ->required()
                                                    ->rows(4),
                                            ])
                                            ->defaultItems(0)
                                            ->collapsed()
                                            ->reorderable()
                                            ->cloneable()
                                            ->addActionLabel('Add FAQ item')
                                            ->columnSpanFull(),
                                    ]),
                            ]),
                        Tabs\Tab::make('Rewards')
                            ->schema([
                                Section::make('Certificates')
                                    ->schema([
                                        FileUpload::make('rewards_certificates')
                                            ->label('Certificate Images')
                                            ->multiple()
                                            ->image()
                                            ->disk('public')
                                            ->directory('rewards/certificates')
                                            ->reorderable()
                                            ->appendFiles()
                                            ->fetchFileInformation(false)
                                            ->helperText('Upload only certificate images. They will appear on the Rewards page in a 3-column grid.')
                                            ->columnSpanFull(),
                                    ]),
                            ]),
                    ]),
            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label(__('filament-panels::resources/pages/edit-record.form.actions.save.label'))
                ->submit('save'),
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();
        Setting::setMany($data);

        Notification::make()
            ->title('Settings saved successfully!')
            ->success()
            ->send();
    }
}
