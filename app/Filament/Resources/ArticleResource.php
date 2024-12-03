<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Filament\Resources\ArticleResource\RelationManagers;
use App\Models\Article;
use DeepCopy\Filter\Filter;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter as FiltersFilter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                TextInput::make('name')->required()
                ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state)))
                ->live(debounce: 1000)
                ->maxLength(255),
                TextInput::make('slug')->readOnly(),
                FileUpload::make('thumbnail')->image()->required(),
                Select::make('is_featured')->required()
                ->options([
                    '1' => 'Featured',
                    '0' => 'Not Featured',
                ]),
                Select::make('author_id')->required()
                ->relationship('author', 'name')
                ->searchable()
                ->preload(),
                Select::make('category_id')->required()
                ->relationship('category', 'name')
                ->searchable()
                ->preload(),
                RichEditor::make('content')->required()->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('name')->searchable(),
                TextColumn::make('slug'),
                ImageColumn::make('thumbnail'),
                // TextColumn::make('is_featured')->badge()
                // ->color(fn (string $state): string => match ($state) {
                //     'featured' => 'success',
                //     'not_featured' => 'danger',
                // }),
                // IconColumn::make('is_featured')
                // ->icon(fn (string $state): string => match ($state) {
                //     '1' => 'heroicon-o-check-circle',
                //     '0' => 'heroicon-o-clock',
                // }),
                IconColumn::make('is_featured')->boolean(),
                TextColumn::make('category.name'),
                TextColumn::make('author.name')->searchable()
            ])
            ->filters([
                FiltersFilter::make('is_featured')
                // ->query(fn (Builder $query): Builder => $query->where('is_featured', true)),
                // SelectFilter::make('is_featured')
                // ->options([
                //     'featured' => 'Featured',
                //     'not_featured' => 'Not Featured',
                // ]),
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
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
