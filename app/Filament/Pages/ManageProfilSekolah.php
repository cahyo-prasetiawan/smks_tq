<?php

namespace App\Filament\Pages;

use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Pages\Page;
use Filament\Notifications\Notification;
use App\Models\Profil; // Model yang benar

// --- IMPORT HYBRID (Layout=Schema, Input=Forms) ---
use Filament\Schemas\Schema;                 
use Filament\Schemas\Components\Section;     
use Filament\Schemas\Components\Grid;        
use Filament\Forms\Components\TextInput;     
use Filament\Forms\Components\Textarea;      
use Filament\Forms\Components\FileUpload;    
use Filament\Forms\Components\RichEditor; 
use Filament\Forms\Components\TagsInput;
// -------------------------------------------------

use UnitEnum;
use BackedEnum;

class ManageProfilSekolah extends Page implements HasForms 
{
   use InteractsWithForms;

     // --- BAGIAN NAVIGASI (WAJIB STATIC) ---
    protected static string|UnitEnum|null $navigationGroup = 'Master Data';
    protected static ?string $navigationLabel = 'Identitas Sekolah';
    
    // ERROR ANDA SEBELUMNYA DI SINI (Kurang 'static')
   protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-building-library';
    protected static ?int $navigationSort = 1;

    // --- BAGIAN VIEW (WAJIB NON-STATIC di Versi Dev) ---
    protected string $view = 'filament.pages.manage-profil-sekolah';

    public ?array $data = [];

    public function mount(): void
    {
        // LOGIC: Ambil data ID 1, kalau tidak ada buat instance baru
        $profil = Profil::firstOrNew(['id' => 1]);
        
        // Isi form
        $this->form->fill($profil->attributesToArray());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                
                // KOLOM KIRI: INFO UTAMA
                Section::make('Info Utama')
                    ->aside()
                    ->schema([
                        FileUpload::make('logo')
                            ->label('Logo Sekolah')
                            ->image()
                            ->disk('public') // Pastikan disk benar
                            ->directory('logo-sekolah') // Folder tujuan
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg']) // Kita tulis manual
                            ->maxSize(5120) // Maksimal 5MB
                            ->visibility('public') 
                            ->columnSpanFull(),
                            

                        TextInput::make('nama')
                            ->label('Nama Sekolah')
                            ->required(),

                        TextInput::make('npsn')
                            ->label('NPSN')
                            ->required(),

                        TextInput::make('email')
                            ->email(),
                        
                        TextInput::make('telepon')
                            ->tel(),

                        Textarea::make('alamat')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),

                // KOLOM KANAN: SOSMED & VIDEO
                Section::make('Media & Konten')
                    ->aside()
                    ->schema([
                        TextInput::make('video_url')
                            ->label('Link Video Profil Sekolah')
                            ->placeholder('Masukkan link YouTube, Google Drive, atau Direct Link MP4'),
                    
                        Grid::make(3)
                            ->schema([
                                TextInput::make('facebook'),
                                TextInput::make('instagram'),
                                TextInput::make('youtube'),
                                TextInput::make('tiktok'),
                            ]),

                        RichEditor::make('visi')
                            ->label('Visi Sekolah')
                            ->columnSpanFull(),
                        
                        TagsInput::make('misi')
                            ->label('Misi Sekolah')
                            ->columnSpanFull(),
                    ]),
            ])
            ->statePath('data');
    }

    public function submit(): void
    {
        try {
            $data = $this->form->getState();

            // LOGIC SIMPAN: Selalu update data ID 1
            Profil::updateOrCreate(
                ['id' => 1], // Kunci pencarian
                $data        // Data yang disimpan
            );

            Notification::make()
                ->title('Identitas Sekolah Disimpan')
                ->success()
                ->send();

        } catch (\Exception $e) {
            Notification::make()
                ->title('Gagal Menyimpan')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }
}
