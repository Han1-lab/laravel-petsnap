<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DiagnosaResource\Pages;
use App\Filament\Resources\DiagnosaResource\RelationManagers;
use App\Models\Diagnosa;
use App\Models\Pet;
use App\Models\Akun;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


class DiagnosaResource extends Resource
{
    protected static ?string $model = Diagnosa::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('hewan_id')
                ->label('Hewan')
                ->options(Pet::all()->pluck('nama', 'id'))
                ->searchable()
                ->required(),
    
            Forms\Components\Select::make('dokter_id')
                ->label('Dokter')
                ->options(Akun::where('role', 'dokter')->pluck('nama', 'id'))
                ->searchable()
                ->required(),
    
            Forms\Components\DatePicker::make('tanggal_diagnosa')
                ->label('Tanggal Diagnosa')
                ->required(),
    
            Forms\Components\Textarea::make('catatan')
                ->label('Catatan Diagnosa')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('hewan.nama')->label('Hewan'),
            Tables\Columns\TextColumn::make('dokter.nama')->label('Dokter'),
            Tables\Columns\TextColumn::make('tanggal_diagnosa')->label('Tanggal'),
            Tables\Columns\TextColumn::make('catatan')->limit(30)->tooltip(fn ($record) => $record->catatan),
        ])
        ->actions([
            Tables\Actions\EditAction::make()->color('edit'),
            Tables\Actions\DeleteAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListDiagnosas::route('/'),
            'create' => Pages\CreateDiagnosa::route('/create'),
            'edit' => Pages\EditDiagnosa::route('/{record}/edit'),
        ];
    }
}
