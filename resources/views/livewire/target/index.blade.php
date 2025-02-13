<div class="space-y-4">
    {{-- Filter Tahunan --}}
    <div class="flex flex-wrap justify-end w-full gap-2">
        <div class="flex items-center gap-2">
            <x-input-label for="tahun" :value="__('Tahun')" />
            <x-select-input id="tahun" wire:model.lazy="selectedTahun" class="">
                <option value="">{{ __('Tahun') }}</option>
                @foreach ($tahuns as $tahun)
                    <option value="{{ $tahun->id }}">
                        {{ $tahun->name }}
                    </option>
                @endforeach
            </x-select-input>
        </div>
    </div>
    {{-- Include child components with selectedTahun as parameter --}}
    <livewire:target.target-tahunan :tahun="$selectedTahun">
        <livewire:target.target-sumber-donasi :tahun="$selectedTahun" />
        <livewire:target.target-sub-infaq :tahun="$selectedTahun" />
        <livewire:target.target-program-sumber :tahun="$selectedTahun" />
        <livewire:target.target-pilar :tahun="$selectedTahun" />
        <livewire:target.target-program-pilar :tahun="$selectedTahun" />
</div>
