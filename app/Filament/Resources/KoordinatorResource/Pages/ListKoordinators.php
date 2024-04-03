<?php

namespace App\Filament\Resources\KoordinatorResource\Pages;

use Filament\Actions;
use Maatwebsite\Excel\Excel;
use Filament\Actions\ImportAction;
use Filament\Pages\Actions\Action;
use Filament\Tables\Actions\BulkAction;
use pxlrbt\FilamentExcel\Columns\Column;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Imports\KoordinatorImporter;
use App\Filament\Resources\KoordinatorResource;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;



class ListKoordinators extends ListRecords
{
    protected static string $resource = KoordinatorResource::class;

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
