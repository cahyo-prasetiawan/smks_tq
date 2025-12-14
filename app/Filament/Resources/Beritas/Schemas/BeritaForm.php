<?php

namespace App\Filament\Resources\Beritas\Schemas;

use App\Models\Peminatan; 
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor; 
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str; 

class BeritaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // 1. Title dengan Auto-Slug
                TextInput::make('title')
                    ->label('Judul Berita')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($set, $state) => $set('slug', Str::slug($state))),

                // 2. Slug (Otomatis & Readonly)
                TextInput::make('slug')
                    ->disabled()
                    ->dehydrated() // Tetap dikirim ke DB meski disabled
                    ->required()
                    ->unique(ignoreRecord: true),

                // 3. Upload Gambar Utama (Cover)
                FileUpload::make('image')
                    ->label('Foto Utama (Cover)')
                    ->image()
                    ->disk('public') // Gunakan disk 'public'
                    ->directory('berita') // Folder penyimpanan
                    ->required()
                    ->columnSpanFull(),

                // 4. Kategori (Dropdown Dinamis)
                Select::make('category')
                    ->label('Kategori')
                    ->options(function () {
                        // 1. Ambil data Peminatan dari database (kolom title)
                        $peminatan = Peminatan::query()->pluck('title', 'title')->toArray();
                        
                        // 2. Opsi Manual (Kegiatan & Akademis)
                        $manual = [
                            'Kegiatan' => 'Kegiatan', 
                            'Akademis' => 'Akademis',
                        ];
                        
                        // 3. Gabungkan: Manual + Peminatan
                        return $manual + $peminatan;
                    })
                    ->searchable() // Agar mudah dicari jika daftar peminatan panjang
                    ->required()
                    ->native(false),

                // 5. Tanggal Terbit
                DatePicker::make('published_at')
                    ->label('Tanggal Terbit')
                    ->required()
                    ->default(now()),

                // 6. Isi Berita (RICH EDITOR - Seperti MS Word)
                // RichEditor::make('content')
                //     ->label('Isi Berita')
                //     ->columnSpanFull()
                //     ->toolbarButtons([
                //         'attachFiles', // Tombol upload gambar
                //         'blockquote',
                //         'bold',
                //         'bulletList',
                //         'codeBlock',
                //         'h2',
                //         'h3',
                //         'italic',
                //         'link',
                //         'orderedList',
                //         'redo',
                //         'strike',
                //         'underline',
                //         'undo',
                //         'table',
                //     ])
                //     ->fileAttachmentsDirectory('berita/konten'), // Folder simpan gambar di dalam artikel

                RichEditor::make('content')
                    ->label('Isi Berita')
                    ->columnSpanFull()
                    ->toolbarButtons([
                        'attachFiles', // Tombol upload gambar
                        'blockquote',
                        'bold',
                        'bulletList',
                        'codeBlock',
                        'h2',
                        'h3',
                        'italic',
                        'link',
                        'orderedList',
                        'redo',
                        'strike',
                        'underline',
                        'undo',
                        'table',
                        'superscript',
                        'subscript',
                        'fontSize',
                        'fontFamily',
                        'textColor',
                        'backgroundColor',
                    ])
                    ->fileAttachmentsDirectory('berita/konten'), // Folder simpan gambar di dalam artikel

                // 7. Status Aktif
                Toggle::make('is_active')
                    ->label('Tampilkan di Website')
                    ->default(true)
                    ->required(),
            ]);
    }
}