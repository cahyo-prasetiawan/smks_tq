<x-filament-panels::page>
    <form wire:submit="submit" class="space-y-6">
        
        {{ $this->form }}

        <div class="flex flex-wrap items-center justify-end gap-3 pt-6 border-t border-gray-200 dark:border-white/10">
            <x-filament::button 
                type="submit" 
                icon="heroicon-m-check"
                wire:loading.attr="disabled"
                wire:target="submit"
            >
                <span wire:loading.remove wire:target="submit">
                    Simpan Perubahan
                </span>
                <span wire:loading wire:target="submit" class="flex items-center gap-1">
                    <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Menyimpan...
                </span>
            </x-filament::button>
        </div>
        
    </form>
    
    <x-filament-actions::modals />
</x-filament-panels::page>