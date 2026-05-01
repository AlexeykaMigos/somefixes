<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogPostResource\Pages;
use App\Models\BlogPost;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BlogPostResource extends Resource
{
    protected static ?string $model = BlogPost::class;

    protected static ?string $navigationIcon = 'heroicon-o-pencil-square';

    protected static ?string $navigationLabel = 'Blog Posts';

    protected static ?string $modelLabel = 'Blog Post';

    protected static ?string $pluralModelLabel = 'Blog Posts';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Post Details')->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Title')
                    ->required()
                    ->columnSpanFull(),

                Forms\Components\Textarea::make('excerpt')
                    ->label('Short Excerpt')
                    ->rows(2)
                    ->helperText('Shown in the blog list as a preview sentence.')
                    ->columnSpanFull(),

                Forms\Components\Select::make('category')
                    ->label('Category')
                    ->options([
                        'care'      => 'Care',
                        'food'      => 'Food',
                        'nutrition' => 'Nutrition',
                        'breeding'  => 'Breeding',
                        'health'    => 'Health',
                    ])
                    ->default('care')
                    ->required(),

                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options(['published' => 'Published', 'draft' => 'Draft'])
                    ->default('published')
                    ->required(),

                Forms\Components\DatePicker::make('published_at')
                    ->label('Publish Date')
                    ->default(now())
                    ->displayFormat('d.m.Y'),

                Forms\Components\TextInput::make('read_time')
                    ->label('Read Time')
                    ->default('5 min')
                    ->placeholder('e.g. 5 min'),
            ])->columns(2),

            Forms\Components\Section::make('Featured Image')->schema([
                Forms\Components\TextInput::make('image_url')
                    ->label('Image URL')
                    ->placeholder('https://images.unsplash.com/photo-...')
                    ->helperText('Paste a direct image URL (Unsplash, Imgur, your CDN, etc.). For inline images inside the article, use the "Attach files" button in the editor below.')
                    ->columnSpanFull(),
            ]),

            Forms\Components\Section::make('Article Content')->schema([
                Forms\Components\RichEditor::make('content')
                    ->label('')
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'underline',
                        'strike',
                        'h2',
                        'h3',
                        'bulletList',
                        'orderedList',
                        'blockquote',
                        'link',
                        'undo',
                        'redo',
                    ])
                    ->helperText('Supports bold, italic, headings, lists, links. To add an image, include an <img> tag in the HTML or paste a URL.')
                    ->columnSpanFull(),
            ]),

            Forms\Components\Section::make('Author Info')->schema([
                Forms\Components\TextInput::make('author_name')
                    ->label('Author Name')
                    ->default('Admin'),

                Forms\Components\TextInput::make('author_role')
                    ->label('Author Role')
                    ->placeholder('e.g. Breeder, Editor'),

                Forms\Components\TextInput::make('author_avatar')
                    ->label('Author Avatar URL')
                    ->placeholder('https://...')
                    ->url(),
            ])->columns(3)->collapsed(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_url')
                    ->label('Image')
                    ->width(80)
                    ->height(50)
                    ->disk('public')
                    ->extraImgAttributes(['style' => 'object-fit:cover;border-radius:8px']),

                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable()
                    ->limit(50),

                Tables\Columns\BadgeColumn::make('category')
                    ->label('Category')
                    ->colors([
                        'primary' => 'care',
                        'success' => 'health',
                        'warning' => 'nutrition',
                        'info'    => 'breeding',
                        'danger'  => 'food',
                    ]),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'success' => 'published',
                        'gray'    => 'draft',
                    ]),

                Tables\Columns\TextColumn::make('published_at')
                    ->label('Date')
                    ->date('d M Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('author_name')
                    ->label('Author')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('published_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(['published' => 'Published', 'draft' => 'Draft']),
                Tables\Filters\SelectFilter::make('category')
                    ->options(['care' => 'Care', 'food' => 'Food', 'nutrition' => 'Nutrition', 'breeding' => 'Breeding', 'health' => 'Health']),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListBlogPosts::route('/'),
            'create' => Pages\CreateBlogPost::route('/create'),
            'edit'   => Pages\EditBlogPost::route('/{record}/edit'),
        ];
    }
}
