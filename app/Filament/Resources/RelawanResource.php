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
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use App\Filament\Resources\RelawanResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use App\Filament\Resources\RelawanResource\RelationManagers;

class RelawanResource extends Resource
{
    protected static ?string $model = Relawan::class;

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
                            ->validationMessages([
                                'unique' => 'The :attribute has already been registered other Koordinator .',
                            ]),
                        TextInput::make('desa')->required(),
                        TextInput::make('rt')
                            ->required()
                            ->label('RT')
                            ->maxLength(2)
                            ->minLength(2)
                            ->numeric()
                            ->validationMessages([
                                'unique' => 'The rt field must not have more than 2 digits',
                            ]),
                        TextInput::make('rw')
                            ->required()
                            ->label('RW')
                            ->maxLength(2)
                            ->minLength(2)
                            ->numeric()
                            ->validationMessages([
                                'unique' => 'The rw field must not have more than 2 digits',
                            ]),
                        TextInput::make('nope')
                            // ->required()
                            ->label('No. HP')
                            // ->maxLength(13)
                            // ->minLength(11)
                            ->numeric()
                            // ->unique(ignoreRecord: true)
                            ,
                        Select::make('koordinator_id')
                            ->relationship('koordinator', 'name')
                            ->required()
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('No')->rowIndex()->sortable(),
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('desa')->searchable(),
                TextColumn::make('rt')->searchable(),
                TextColumn::make('rw')->searchable(),
                TextColumn::make('nope')->searchable()
                    ->label('No. HP'),
                TextColumn::make('koordinator.name')->searchable()->sortable(),
            ])
            ->filters([
                SelectFilter::make('koordinator Name')
                    ->relationship('koordinator', 'name')
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                ExportBulkAction::make()->exports([
                    ExcelExport::make()->fromTable()->only([
                        'name', 'desa', 'rt','rw', 'nope', 'koordinator.name',
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRelawans::route('/'),
            'create' => Pages\CreateRelawan::route('/create'),
            'edit' => Pages\EditRelawan::route('/{record}/edit'),
        ];
    }
}
