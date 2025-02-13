<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Target Program') }}
        </h2>
    </x-slot>

    <div class="sm:py-6">
        <div class="max-w-full mx-auto sm:px-6 sm:space-y-6">
            <x-card.app>
                <x-card.title>
                    {{ __('Edit Data Target Program') }}
                </x-card.title>
                <x-card.description>
                    {{ __('Edit a new Data Target Program.') }}
                </x-card.description>
                <div class="max-w-xl">
                    <form method="post" action="{{ route('targetprogrampilar.update', $targetprogrampilar) }}" class="mt-6 space-y-6">
                        @csrf
                        @method('patch')
                        <div>
                            <x-input-label for="program_pilar_id" :value="__('Program')" />
                            <x-select-input id="program_pilar" name="program_pilar_id" class="block w-full mt-1">
                                <option value="">{{ __('Select Program') }}</option>
                                @foreach ($programPilars as $programPilar)
                                    <option value="{{ $programPilar->id }}"
                                        {{ $programPilar->id == $targetprogrampilar->programPilar->id ? 'selected' : '' }}>
                                        {{ $programPilar->name }}
                                        </option>
                                @endforeach
                            </x-select-input>
                            <x-input-error class="mt-2" :messages="$errors->get('program_pilar_id')" />
                        </div>

                        <div>
                            <x-input-label for="nominal" :value="__('Persentage (%)')" />
                            <x-text-input id="nominal" name="nominal" type="number" class="block w-full mt-1" required
                                :value="old('nominal', $targetprogrampilar->nominal)" autocomplete="nominal" min="0" placeholder="0.00" step="0.01"/>
                            <x-input-error class="mt-2" :messages="$errors->get('nominal')" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="tahun_id" :value="__('Tahun')" />
                            <x-select-input id="tahun" name="tahun_id" class="block w-full mt-1">
                                <option value="">{{ __('Select Tahun') }}</option>
                                @foreach ($tahuns as $tahun)
                                <option value="{{ $tahun->id }}"
                                    {{ $tahun->id == $targetprogrampilar->tahun->id ? 'selected' : '' }}>
                                    {{ $tahun->name }}
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
