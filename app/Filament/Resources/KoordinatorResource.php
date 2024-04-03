<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Relawan;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Koordinator;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use Filament\Tables\Actions\Contracts\HasTable;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\KoordinatorResource\Pages;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use App\Filament\Resources\KoordinatorResource\RelationManagers;

class KoordinatorResource extends Resource
{
    protected static ?string $model = Koordinator::class;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->placeholder('Nama')
                            ->validationMessages([
                                'unique' => 'The :attribute has already been registered.',
                            ]),
                        TextInput::make('desa')->required()
                            ->maxLength(255)
                            ->placeholder('Desa'),
                        TextInput::make('nope')
                            ->label('No. HP')
                            // ->maxLength(13)
                            // ->minLength(11)
                            ->placeholder('No. HP')
                            ->numeric()
                            // ->unique(ignoreRecord: true)
                            ,
                    ])
                    ->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {

        return $table
            ->columns([
                TextColumn::make('No')->rowIndex()->sortable(),
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('desa')->searchable(),
                TextColumn::make('nope')
                    ->label('No. HP')
                    ->searchable(),
                // TextColumn::make('relawan'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                ExportBulkAction::make()->exports([
                    ExcelExport::make()->fromTable()->only([
                        'name', 'desa', 'nope',
                    ]),
                ]),
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\RelawanRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKoordinators::route('/'),
            'create' => Pages\CreateKoordinator::route('/create'),
            'edit' => Pages\EditKoordinator::route('/{record}/edit'),
        ];
    }
}
