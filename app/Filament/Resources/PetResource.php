<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PetResource\Pages;
use App\Filament\Resources\PetResource\RelationManagers;
use App\Models\Pet;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\Akun;


class PetResource extends Resource
{
    protected static ?string $model = Pet::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')->required(),
                Forms\Components\TextInput::make('jenis')->required(),
                Forms\Components\TextInput::make('usia')->required()->numeric(),
                Forms\Components\TextInput::make('kondisi')->required(),
                Forms\Components\FileUpload::make('foto')
                ->label('Foto Hewan')
                ->image()
                ->directory('foto-hewan')
                ->maxSize(2048) // 2MB
                ->preserveFilenames(),
                //->searchable(),
                Forms\Components\Select::make('pemilik_id')
                    ->options(Akun::all()->pluck('nama', 'id'))  // Menampilkan daftar pemilik
                    ->required()
                    ->label('Pemilik'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')->searchable(),
                Tables\Columns\TextColumn::make('jenis'),
                Tables\Columns\TextColumn::make('usia'),
                Tables\Columns\TextColumn::make('kondisi'),
                Tables\Columns\ImageColumn::make('foto')->label('Foto')->circular(),
                Tables\Columns\TextColumn::make('pemilik.nama')->label('Pemilik'),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->toggleable(),
                Tables\Columns\TextColumn::make('updated_at')->dateTime()->toggleable(),
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
            'index' => Pages\ListPets::route('/'),
            'create' => Pages\CreatePet::route('/create'),
            'edit' => Pages\EditPet::route('/{record}/edit'),
        ];
    }

    public function pemilik()
    {
        return $this->belongsTo(Akun::class, 'pemilik_id');
    }

}
