<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Create Data Target Program Sumber') }}
        </h2>
    </x-slot>

    <div class="sm:py-6">
        <div class="max-w-full mx-auto sm:px-6 sm:space-y-6">
            <x-card.app>
                <x-card.title>
                    {{ __('Create Data Target Program Sumber') }}
                </x-card.title>
                <x-card.description>
                    {{ __('Create a new Data Target Program Sumber.') }}
                </x-card.description>
                <div class="max-w-xl">
                    <form method="post" action="{{ route('targetprogramsumber.update', $targetprogramsumber) }}"
                        class="mt-6 space-y-6">
                        @csrf
                        @method('patch')
                        <div>
                            <x-input-label for="program_sumber_id" :value="__('Sumber Donasi')" />
                            <x-select-input id="program_sumber" name="program_sumber_id" class="block w-full mt-1" required>
                                <option value="">{{ __('Select Sumber Donasi') }}</option>
                                @foreach ($programSumbers as $programSumber)
                                    <option value="{{ $programSumber->id }}"
                                        {{ $programSumber->id == $targetprogramsumber->programSumber->id ? 'selected' : '' }}>
                                        {{ $programSumber->name }}
                                    </option>
                                @endforeach
                            </x-select-input>
                            <x-input-error class="mt-2" :messages="$errors->get('program_sumber_id')" />
                        </div>

                        <div>
                            <x-input-label for="nominal" :value="__('Persentage (%)')" />
                            <x-text-input id="nominal" name="nominal" type="number" class="block w-full mt-1" required
                                :value="old('nominal', $targetprogramsumber->nominal)" autocomplete="nominal" min="0" placeholder="0.00" step="0.01"/>
                            <x-input-error class="mt-2" :messages="$errors->get('nominal')" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="tahun_id" :value="__('Tahun')" />
                            <x-select-input id="tahun" name="tahun_id" class="block w-full mt-1" required>
                                <option value="">{{ __('Select Tahun') }}</option>
                                @foreach ($tahuns as $tahun)
                                    <option value="{{ $tahun->id }}"
                                        {{ $tahun->id == $targetprogramsumber->tahun->id ? 'selected' : '' }}>
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
