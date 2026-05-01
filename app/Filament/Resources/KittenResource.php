<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KittenResource\Pages;
use App\Filament\Resources\KittenResource\RelationManagers;
use App\Models\Kitten;
use App\Models\Litter;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Select;

class KittenResource extends Resource
{
    protected static ?string $model = Kitten::class;

    protected static ?string $navigationIcon = 'heroicon-o-sparkles';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Litter')
                    ->schema([
                        Select::make('litter_id')
                            ->label('Litter (Помёт)')
                            ->relationship('litter', 'name')
                            ->searchable()
                            ->placeholder('— No litter —')
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')->required()->label('Litter Name'),
                                Forms\Components\Select::make('status')
                                    ->options(['available' => 'Available Now', 'upcoming' => 'Upcoming'])
                                    ->default('available'),
                                Forms\Components\DatePicker::make('date')->label('Birth / Expected Date'),
                                Forms\Components\TextInput::make('sort_order')->numeric()->default(0)->label('Sort Order'),
                            ])
                            ->columnSpanFull(),
                    ]),

                Section::make('General Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required(),
                        Forms\Components\TextInput::make('price')
                            ->required(),
                        Forms\Components\TextInput::make('old_price'),
                        Forms\Components\DatePicker::make('birth_date'),
                        Select::make('gender')
                            ->options([
                                'Male' => 'Male',
                                'Female' => 'Female',
                            ]),
                        Forms\Components\TextInput::make('age'),
                        Forms\Components\TextInput::make('breed_type')
                            ->required(),
                        Forms\Components\TextInput::make('character'),
                        Select::make('status')
                            ->options([
                                'available' => 'Available',
                                'reserved' => 'Reserved',
                                'sold' => 'Sold',
                                'exclusive' => 'Exclusive (Offer Today)',
                            ])
                            ->required()
                            ->default('available'),
                    ])->columns(2),

                Section::make('Details & Media')
                    ->schema([
                        Forms\Components\Textarea::make('description')
                            ->columnSpanFull(),
                        TagsInput::make('tags')
                            ->columnSpanFull(),
                        TagsInput::make('features')
                            ->columnSpanFull(),
                        FileUpload::make('gallery')
                            ->multiple()
                            ->image()
                            ->disk('public')
                            ->directory('kittens/gallery')
                            ->imageEditor()
                            ->reorderable()
                            ->appendFiles()
                            ->fetchFileInformation(false)
                            ->columnSpanFull(),
                    ]),

                Section::make('Parents Information')
                    ->schema([
                        Forms\Components\Toggle::make('show_parents')
                            ->reactive()
                            ->columnSpanFull(),
                        
                        Forms\Components\Group::make([
                            Section::make('Mother')
                                ->schema([
                                    Forms\Components\TextInput::make('mother_title')->label('Role (e.g. Mother)'),
                                    Forms\Components\TextInput::make('mother_name')->label('Name'),
                                    Forms\Components\TextInput::make('mother_breed')->label('Breed'),
                                    FileUpload::make('mother_photo')
                                        ->image()
                                        ->disk('public')
                                        ->directory('kittens/parents')
                                        ->fetchFileInformation(false),
                                ])->columnSpan(1),
                            
                            Section::make('Father')
                                ->schema([
                                    Forms\Components\TextInput::make('father_title')->label('Role (e.g. Father)'),
                                    Forms\Components\TextInput::make('father_name')->label('Name'),
                                    Forms\Components\TextInput::make('father_breed')->label('Breed'),
                                    FileUpload::make('father_photo')
                                        ->image()
                                        ->disk('public')
                                        ->directory('kittens/parents')
                                        ->fetchFileInformation(false),
                                ])->columnSpan(1),
                        ])
                        ->columns(2)
                        ->hidden(fn ($get) => !$get('show_parents')),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('gallery')
                    ->label('Photo')
                    ->circular()
                    ->stacked()
                    ->limit(3)
                    ->disk('public'),
                Tables\Columns\TextColumn::make('litter.name')
                    ->label('Litter')
                    ->badge()
                    ->color('info')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->sortable(),
                Tables\Columns\TextColumn::make('old_price')
                    ->label('Old Price')
                    ->sortable(),
                Tables\Columns\TextColumn::make('breed_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'available' => 'success',
                        'reserved' => 'warning',
                        'sold' => 'danger',
                        default => 'gray',
                    }),
                Tables\Columns\IconColumn::make('show_parents')
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKittens::route('/'),
            'create' => Pages\CreateKitten::route('/create'),
            'edit' => Pages\EditKitten::route('/{record}/edit'),
        ];
    }
}
