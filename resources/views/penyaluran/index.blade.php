<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Penyaluran') }}
        </h2>
    </x-slot>

    <div class="sm:py-7">
        <div class="max-w-full mx-auto sm:px-6 sm:space-y-6">
            <x-card.app>
                <div class="justify-between w-full md:flex">
                    <x-card.title>
                        {{ __('Data Penyaluran') }}
                    </x-card.title>
                    <div>
                        @can('create', App\Models\Penyaluran::class)
                            <div class="flex flex-wrap gap-2">
                                <x-button.link-primary href="{{ route('penyaluran.create') }}">
                                    {{ __('Create') }}
                                </x-button.link-primary>
                                <x-button.link-primary href="{{ route('penyaluran.importexel') }}">
                                    {{ __('Import Exel') }}
                                </x-button.link-primary>
                                {{-- <x-button.link-primary href="{{ route('penyaluran.export') }}">
                                {{ __('Export Exel') }}
                            </x-button.link-primary> --}}
                                <x-button.link-primary href="{{ route('penyaluran.importcsv') }}">
                                    {{ __('Import CSV') }}
                                </x-button.link-primary>
                                {{-- <x-button.link-primary href="{{ route('penyaluran.exportcsv') }}">
                                {{ __('Export CSV') }}
                            </x-button.link-primary> --}}
                                <x-button.link-primary href="{{ route('penyaluran.export') }}">
                                    {{ __('Export') }}
                                </x-button.link-primary>
                            </div>
                        @endcan
                    </div>
                </div>

                @livewire('penyaluran.table')

            </x-card.app>
        </div>
    </div>
</x-app-layout>
