<?php

namespace App\Filament\Imports;

use App\Models\Koordinator;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class KoordinatorImporter extends Importer
{
    protected static ?string $model = Koordinator::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('name')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('desa')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('nope')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'numeric','min:11','max:13']),
        ];
    }

    public function resolveRecord(): ?Koordinator
    {
        // return Koordinator::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'name' => $this->data['name'],
        //     'desa' => $this->data['desa'],
        //     'nope' => $this->data['nope'],
        // ]);

        return new Koordinator();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your koordinator import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
