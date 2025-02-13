<x-card.app>
    <div class="justify-between w-full md:flex">
        <x-card.title>
            {{ __('Target Program Sumber') }}
        </x-card.title>
        <div class="flex flex-wrap gap-2">
            <x-button.link-secondary href="{{ route('targetprogramsumber.index') }}">
                {{ __('Manage Target Program Sumber') }}
            </x-button.link-secondary>
        </div>
    </div>
    <div class="relative mt-6 overflow-x-visible overflow-y-visible rounded-md md:block">
        <table class="w-full text-base text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        {{ __('No.') }}
                    </th>
                    <th scope="col" class="px-6 py-3 lg:table-cell">
                        {{ __('Program Sumber') }}
                    </th>
                    <th scope="col" class="px-6 py-3 lg:table-cell">
                        {{ __('Persentage') }}
                    </th>
                    <th scope="col" class="px-6 py-3 lg:table-cell">
                        {{ __('Tahun') }}
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($targetProgramSumbers as $targetProgramSumber)
                <tr class="odd:bg-white odd:dark:bg-gray-800 even:bg-gray-100 even:dark:bg-gray-700">
                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-gray-200">
                        {{-- loop --}}
                        <div class="flex">
                            <div class="hover:underline whitespace-nowrap">
                                {{ $loop->iteration }}
                            </div>
                        </div>
                    </td>

                    </td>
                    <td class="px-6 py-4 lg:table-cell">
                        <div class="flex">
                            <p>
                                {{ $targetProgramSumber->programSumber->name ?? '-' }}
                            </p>
                        </div>
                    </td>
                    <td x-data="{nominal: {{ $targetProgramSumber->nominal }}}"
                        class="px-6 py-4 lg:table-cell">
                        <div class="flex">
                            <p x-text="nominal.toString()+' %'"></p>
                        </div>
                    </td>
                    <td class="px-6 py-4 lg:table-cell">
                        <div class="flex">
                            {{ $targetProgramSumber->tahun->name ?? '-' }}
                        </div>
                    </td>
                </tr>
            @empty
                <tr class="bg-white dark:bg-gray-800">
                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-gray-200">
                        Empty
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</x-card.app>
