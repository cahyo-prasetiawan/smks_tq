<?php

namespace App\Filament\Resources\Sliders\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Forms\Components\RichEditor;

class SliderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
               
                    TextInput::make('badge')
                        ->label('Badge / Label Kecil')
                        ->placeholder('Contoh: Selamat Datang')
                        ->required(),

                    TextInput::make('title')
                        ->label('Judul Slider')
                        ->placeholder('Masukkan Judul')
                        ->required(),
                 
                    TextInput::make('desc')
                        ->label('Deskripsi')
                        ->placeholder('Deskripsi Singkat')
                        ->required(),


                    FileUpload::make('image')
                        ->label('Gambar Background')
                        ->image()
                        ->disk('public')
                        ->visibility('public')
                        ->directory('sliders') // Gambar akan disimpan di storage/app/public/sliders
                        ->required()
                        ->columnSpanFull(),

                    Toggle::make('is_active')
                        ->label('Aktifkan Slide ini?')
                        ->default(true),
              
            ]);
    }
}
