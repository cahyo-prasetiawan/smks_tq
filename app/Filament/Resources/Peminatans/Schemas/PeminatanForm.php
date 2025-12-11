<?php

namespace App\Filament\Resources\Peminatans\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TagsInput;
use Illuminate\Support\Str;
use App\Models\Peminatan;
use Filament\Forms\Components\RichEditor;

class PeminatanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                 TextInput::make('title')
                ->label('Nama Peminatan')
                ->required()
                ->maxLength(255)
                ->live(onBlur: true)
                ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),

            TextInput::make('slug')
                ->required()
                ->disabled()
                ->dehydrated()
                ->unique(Peminatan::class, 'slug', ignoreRecord: true),
                
                TextInput::make('nomer_penanggung_jawab')
                    ->label('Nomor Penanggung Jawab')
                    ->placeholder('Masukkan nomor telepon/WA penanggung jawab')
                    ->maxLength(50)
                    ->columnSpanFull(),
                    
                RichEditor::make('description')
                    ->label('Deskripsi')
                    ->columnSpanFull()
                    ->toolbarButtons([ // Tombol upload gambar
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
                    ])
                    ->required(),

                FileUpload::make('image')
                    ->disk('public') // Pastikan disk benar
                    ->directory('uploads') // Folder tujuan
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg']) // Kita tulis manual
                    ->maxSize(5120) // Maksimal 5MB
                    ->visibility('public') // <--- WAJIB ADA: Agar file bisa diakses via URL browser
                    ->preserveFilenames() // Opsional: Agar nama file asli tidak diacak
                    ->imageEditor() // Opsional: Fitur crop/edit gambar bawaan Filament
                    ->columnSpanFull(),
                TextInput::make('video_url')
                    ->label('Link Video Profil')
                    ->placeholder('Masukkan link YouTube, Google Drive, atau Direct Link MP4')
                    ->url() // Validasi format URL
                    ->suffixIcon('heroicon-m-video-camera')
                    ->columnSpanFull(), // Agar lebar penuh

               TagsInput::make('facilities')
                    ->placeholder('Ketik fasilitas lalu tekan Enter (Contoh: AC)')
                    ->columnSpanFull(),
            ]);
    }
}
