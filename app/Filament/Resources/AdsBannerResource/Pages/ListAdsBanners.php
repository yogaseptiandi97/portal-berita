<?php

namespace App\Filament\Resources\AdsBannerResource\Pages;

use App\Filament\Resources\AdsBannerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAdsBanners extends ListRecords
{
    protected static string $resource = AdsBannerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
