<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LitterResource\Pages;
use App\Models\Litter;
use App\Models\Kitten;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class LitterResource extends Resource
{
    protected static ?string $model = Litter::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Litters (Помёты)';

    protected static ?string $modelLabel = 'Litter';

    protected static ?string $pluralModelLabel = 'Litters';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Litter Info')->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Litter Name')
                    ->placeholder('e.g. Помет А, Litter B')
                    ->required(),

                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'available' => 'Available Now',
                        'upcoming'  => 'Upcoming Litter',
                    ])
                    ->default('available')
                    ->required(),

                Forms\Components\DatePicker::make('date')
                    ->label('Birth / Expected Date')
                    ->displayFormat('d.m.Y'),

                Forms\Components\TextInput::make('sort_order')
                    ->label('Sort Order (0 = first)')
                    ->numeric()
                    ->default(0),
            ])->columns(2),

            Forms\Components\Section::make('Kittens in this Litter')
                ->description('Kittens assigned to this litter')
                ->schema([
                    Forms\Components\Repeater::make('kittens')
                        ->relationship()
                        ->label('')
                        ->schema([
                            Forms\Components\TextInput::make('name')
                                ->label('Name')
                                ->required(),
                            Forms\Components\TextInput::make('price')
                                ->label('Price ($)')
                                ->numeric(),
                            Forms\Components\Select::make('status')
                                ->label('Availability')
                                ->options([
                                    'available' => 'Available',
                                    'reserved'  => 'Reserved',
                                    'sold'      => 'Sold',
                                ])
                                ->default('available'),
                            Forms\Components\Select::make('gender')
                                ->label('Gender')
                                ->options(['Male' => 'Male', 'Female' => 'Female'])
                                ->default('Male'),
                            Forms\Components\FileUpload::make('gallery')
                                ->label('Photos')
                                ->multiple()
                                ->image()
                                ->disk('public')
                                ->directory('kittens/gallery')
                                ->reorderable()
                                ->fetchFileInformation(false)
                                ->maxFiles(15),
                            Forms\Components\TextInput::make('breed_type')
                                ->label('Breed Type'),
                            Forms\Components\Textarea::make('description')
                                ->label('Description')
                                ->rows(2),
                        ])
                        ->columns(3)
                        ->addActionLabel('+ Add Kitten to Litter')
                        ->reorderable(false)
                        ->collapsed(),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('#')
                    ->sortable()
                    ->width(50),

                Tables\Columns\TextColumn::make('name')
                    ->label('Litter Name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'success' => 'available',
                        'warning' => 'upcoming',
                    ])
                    ->formatStateUsing(fn ($state) => match($state) {
                        'available' => 'Available Now',
                        'upcoming'  => 'Upcoming',
                        default     => $state,
                    }),

                Tables\Columns\TextColumn::make('date')
                    ->label('Date')
                    ->date('d.m.Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('kittens_count')
                    ->label('Kittens')
                    ->counts('kittens')
                    ->badge()
                    ->color('primary'),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Updated')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('sort_order')
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->requiresConfirmation()
                    ->modalDescription('This will also remove the litter assignment from all kittens in it. The kittens themselves will NOT be deleted.'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListLitters::route('/'),
            'create' => Pages\CreateLitter::route('/create'),
            'edit'   => Pages\EditLitter::route('/{record}/edit'),
        ];
    }
}
