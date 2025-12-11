<x-filament-panels::page>
    <form wire:submit="submit" class="space-y-6">
        
        {{ $this->form }}

        <div class="flex flex-wrap items-center justify-end gap-3 pt-4 border-t border-gray-200 dark:border-white/10">
            
            <x-filament::button 
                type="button" 
                color="gray" 
                tag="a"
                href="{{ filament()->getHomeUrl() }}"
            >
                Batal
            </x-filament::button>

            <x-filament::button 
                type="submit" 
                icon="heroicon-m-check"
                wire:loading.attr="disabled"
                wire:target="submit"
            >
                <span wire:loading.remove wire:target="submit">
                    Simpan Perubahan
                </span>

                <span wire:loading wire:target="submit">
                    Menyimpan...
                </span>
            </x-filament::button>
        </div>
        
    </form>

    <x-filament-actions::modals />
</x-filament-panels::page>