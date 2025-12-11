<?php

namespace App\Filament\Pages;

use App\Models\User;
use Filament\Pages\Page;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Schemas\Schema;                 // Wadah Utama
use Filament\Schemas\Components\Section;     // Layout pindah ke Schemas
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use UnitEnum;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem; 
use Filament\Navigation\NavigationLabel;
use Filament\Navigation\NavigationSection;
use Filament\Navigation\NavigationBuilder;
use BackedEnum;

class ProfilAdmin extends Page implements HasForms 
{
    use InteractsWithForms;

   // --- PERBAIKAN TIPE DATA (Harus string|UnitEnum|null) ---
    protected string $view = 'filament.pages.profil-admin';
     // GANTI baris yang lama dengan ini:
    protected static string|UnitEnum|null $navigationGroup = 'Master Data'; 
    
    // Jaga-jaga, perbaiki juga navigationIcon agar sesuai standar Filament V3
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-user-circle'; 
    
    protected static ?string $navigationLabel = 'Profil Admin'; 
    protected static ?int $navigationSort = 2;

    public ?array $data = [];

    public function mount(): void
    {
        // Isi form dengan data user saat ini
        $this->form->fill(auth()->user()->attributesToArray());
    }

   public function form(Schema $schema): Schema 
    {
        return $schema
            ->schema([
                // Section diambil dari Filament\Schemas\Components\Section
                Section::make('Informasi Akun')
                    ->description('Perbarui informasi profil dan kata sandi Anda.')
                    ->schema([
                        // TextInput diambil dari Filament\Forms\Components\TextInput
                        TextInput::make('name')
                            ->label('Nama Lengkap')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('email')
                            ->label('Alamat Email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true),

                        TextInput::make('password')
                            ->label('Password Baru')
                            ->password()
                            ->revealable()
                            ->rule(Password::default())
                            ->dehydrated(fn ($state) => filled($state))
                            ->required(false),
                        
                        TextInput::make('password_confirmation')
                            ->label('Ulangi Password Baru')
                            ->password()
                            ->revealable()
                            ->same('password')
                            ->dehydrated(false),
                    ])->columns(2),
            ])
            ->statePath('data');
    }
    
    public function submit(): void
    {
        try {
            $data = $this->form->getState();
            $user = auth()->user();

            if (!empty($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            } else {
                unset($data['password']);
            }

            $user->update($data);

            Notification::make()
                ->title('Profil berhasil diperbarui!')
                ->success()
                ->send();
        
        } catch (\Exception $e) {
            Notification::make()
                ->title('Gagal menyimpan.')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }
}