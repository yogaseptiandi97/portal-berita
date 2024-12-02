<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdsBannerResource\Pages;
use App\Filament\Resources\AdsBannerResource\RelationManagers;
use App\Models\AdsBanner;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AdsBannerResource extends Resource
{
    protected static ?string $model = AdsBanner::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                TextInput::make('link')->required()->maxLength(255),

                Select::make('is_active')->required()
                ->options([
                    'active' => 'Active',
                    'not_active' => 'Not Active',
                ]),
                Select::make('type')->required()
                ->options([
                    'banner' => 'Banner',
                    'square' => 'Square',
                ]),
                FileUpload::make('thumbnail')->image()->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('link')->searchable(),
                TextColumn::make('is_active')->badge()
                ->color(fn (string $state): string => match($state){
                    'active' => 'success',
                    'not_active' => 'danger',
                }),
                ImageColumn::make('thumbnail')



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
            'index' => Pages\ListAdsBanners::route('/'),
            'create' => Pages\CreateAdsBanner::route('/create'),
            'edit' => Pages\EditAdsBanner::route('/{record}/edit'),
        ];
    }
}
