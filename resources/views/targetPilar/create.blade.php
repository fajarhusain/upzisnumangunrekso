<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Create Data Target Pilar') }}
        </h2>
    </x-slot>

    <div class="sm:py-6">
        <div class="max-w-full mx-auto sm:px-6 sm:space-y-6">
            <x-card.app>
                <x-card.title>
                    {{ __('Create Data Target Pilar') }}
                </x-card.title>
                <x-card.description>
                    {{ __('Create a new Data Target Pilar.') }}
                </x-card.description>
                <div class="max-w-xl">
                    <form method="post" action="{{ route('targetpilar.store') }}" class="mt-6 space-y-6">
                        @csrf
                        @method('post')
                        <div>
                            <x-input-label for="pilar_id" :value="__('Pilar')" />
                            <x-select-input id="pilar" name="pilar_id" class="block w-full mt-1" required>
                                <option value="">{{ __('Select Pilar') }}</option>
                                @foreach ($pilars as $pilar)
                                    <option value="{{ $pilar->id }}"
                                        {{ request('pilar_id') == 'pilar_id' ? 'selected' : '' }}>
                                        {{ $pilar->name }}
                                    </option>
                                @endforeach
                            </x-select-input>
                            <x-input-error class="mt-2" :messages="$errors->get('pilar_id')" />
                        </div>

                        <div>
                            <x-input-label for="nominal" :value="__('Persentage(%)')" />
                            <x-text-input id="nominal" name="nominal" type="number" class="block w-full mt-1"
                                :value="old('nominal')" autocomplete="nominal" min="0" step="0.01"
                                placeholder="0.00" required/>
                            <x-input-error class="mt-2" :messages="$errors->get('nominal')" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="tahun_id" :value="__('Tahun')" />
                            <x-select-input id="tahun" name="tahun_id" class="block w-full mt-1" required>
                                <option value="">{{ __('Select Tahun') }}</option>
                                @foreach ($tahuns as $tahun)
                                    <option value="{{ $tahun->id }}"
                                        {{ request('tahun_id') == 'tahun_id' ? 'selected' : '' }}> {{ $tahun->name }}
                                    </option>
                                @endforeach
                            </x-select-input>
                            <x-input-error class="mt-2" :messages="$errors->get('tahun_id')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-button.primary>{{ __('Save') }}</x-button.primary>
                        </div>
                    </form>
                </div>
            </x-card.app>
        </div>
    </div>
</x-app-layout>
