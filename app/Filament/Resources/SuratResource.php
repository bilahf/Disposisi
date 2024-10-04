<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Surat;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Actions;
use Illuminate\Support\Facades\Storage;
use Filament\Notifications\Notification;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Actions\Action;
use App\Filament\Resources\SuratResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SuratResource\RelationManagers;

class SuratResource extends Resource
{
    protected static ?string $model = Surat::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('file')
                ->downloadable(),
                Select::make('mahasiswa_id')
                ->relationship('mahasiswa','nama'),

                Forms\Components\Select::make('jenis_surat')
                    ->label('Jenis Surat')
                    ->options([
                        'Keterangan Aktif Kuliah' => 'Keterangan Aktif Kuliah',
                        'Izin Magang' => 'Izin Magang',
                        'Izin Penelitian' => 'Izin Penelitian',
                    ])
                    ->reactive()  // Mengubah form sesuai pilihan jenis surat
                    ->required(),

                Forms\Components\Fieldset::make('Detail Surat')
                    ->schema(function ($get) {
                        if ($get('jenis_surat') === 'Keterangan Aktif Kuliah') {
                            return [
                                Forms\Components\TextInput::make('detail_surat.tahun_ajaran')
                                    ->label('Tahun Ajaran')
                                    ->required(),
                                Forms\Components\TextInput::make('detail_surat.semester')
                                    ->label('Semester')
                                    ->required(),
                            ];
                        }

                        if ($get('jenis_surat') === 'Izin Magang') {
                            return [
                                Forms\Components\TextInput::make('detail_surat.perusahaan')
                                    ->label('Perusahaan')
                                    ->required(),
                                Forms\Components\DatePicker::make('detail_surat.tanggal_mulai')
                                    ->label('Tanggal Mulai')
                                    ->required(),
                                Forms\Components\DatePicker::make('detail_surat.tanggal_selesai')
                                    ->label('Tanggal Selesai')
                                    ->required(),
                            ];
                        }

                        if ($get('jenis_surat') === 'Izin Penelitian') {
                            return [
                                Forms\Components\TextInput::make('detail_surat.judul_penelitian')
                                    ->label('Judul Penelitian')
                                    ->required(),
                                Forms\Components\TextInput::make('detail_surat.dosen_pembimbing')
                                    ->label('Dosen Pembimbing')
                                    ->required(),
                            ];
                        }

                        return [];
                    }),

                Forms\Components\DatePicker::make('tanggal_pengajuan')
                    ->default(now())
                    ->label('Tanggal Pengajuan')
                    ->readOnly()  // Otomatis set ke tanggal saat ini
                    ->required(),

                    
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('mahasiswa.nama')
                ->sortable()
                ->label('Mahasiswa'),
                Tables\Columns\TextColumn::make('jenis_surat')->label('Jenis Surat'),
                Tables\Columns\TextColumn::make('tanggal_pengajuan')->label('Tanggal Pengajuan'),
                Tables\Columns\TextColumn::make('status')->label('Status'),

                Tables\Columns\TextColumn::make('created_at')->label('Tanggal Dibuat'),
                Tables\Columns\TextColumn::make('updated_at')->label('Tanggal Terakhir Diubah'),


            ])
            ->filters([
                // Filter status surat, misalnya Menunggu, Disetujui, Ditolak
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListSurats::route('/'),
            'create' => Pages\CreateSurat::route('/create'),
            'edit' => Pages\EditSurat::route('/{record}/edit'),
        ];
    }
}
