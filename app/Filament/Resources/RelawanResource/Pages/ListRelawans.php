<?php

namespace App\Filament\Resources\RelawanResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\RelawanResource;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;

class ListRelawans extends ListRecords
{
    protected static string $resource = RelawanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),

            // ExportAction::make()
            // ->label('Export ALL')
            // ->color('info'),
        ];
    }
}
