<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Import Data Penghimpunan') }}
        </h2>
    </x-slot>

    <div class="sm:py-6">
        <div class="max-w-full mx-auto sm:px-6 sm:space-y-6">
            <x-card.app>
                <x-card.title>
                    {{ __('Import Data Penghimpunan') }}
                </x-card.title>
                <x-card.description>
                    {{ __('Create a new Data Penghimpunan.') }}
                </x-card.description>
                <div class="max-w-xl">
                    <form method="post" action="{{ route('penghimpunan.importfileexel') }}" class="mt-6 space-y-6"
                        enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <div class="w-full max-w-sm">
                            <x-input-label for="doc" :value="__('Upload File')" />
                            <x-file-input name="doc"
                                accept="application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
                                class="mt-1 dark:text-gray-400"></x-file-input>
                            <x-input-helper>
                                Format : xlx, xlxs
                            </x-input-helper>
                            <x-input-error class="mt-2" :messages="$errors->get('doc')" />
                        </div>
                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Import') }}</x-primary-button>

                            @if ($errors->has('import_errors'))
                                <div class="alert alert-danger" role="alert">
                                    @foreach ($errors->get('import_errors') as $errorGroup)
                                        @php
                                            $error = json_decode($errorGroup, true);
                                        @endphp
                                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 10000)"
                                            class="text-sm text-red-600 dark:text-red-400">
                                            Errors: {{ implode(', ', $error['messages']) }} <br>
                                            Baris ke: {{ $error['row'] }}, Kolom: {{ $error['attribute'] }} <br>
                                            {{-- Values: {{ json_encode($error['values']) }} --}}
                                        </p>
                                    @endforeach
                                </div>
                            @elseif (session('success'))
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 10000)"
                                    class="text-sm text-green-600 dark:text-green-400">{{ __('Imported.') }}</p>
                            @endif
                        </div>
                    </form>
                </div>
            </x-card.app>
        </div>
    </div>
</x-app-layout>
