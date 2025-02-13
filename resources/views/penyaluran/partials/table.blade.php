{{-- <div class="relative mt-6 overflow-auto rounded-md"> --}}
    <table class="w-full text-base text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    {{ __('No.') }}
                </th>
                <th scope="col" class="px-6 py-3 xl:table-cell">
                    {{ __('Tanggal') }}
                </th>
                <th scope="col" class="px-6 py-3 lg:table-cell">
                    {{ __('Nominal') }}
                </th>
                <th scope="col" class="px-6 py-3 lg:table-cell">
                    {{ __('Pilar') }}
                </th>
                <th scope="col" class="px-6 py-3 lg:table-cell">
                    {{ __('Program') }}
                </th>
                <th scope="col" class="px-6 py-3 lg:table-cell">
                    {{ __('Ashnaf') }}
                </th>
                <th scope="col" class="px-6 py-3 lg:table-cell">
                    {{ __('Lembaga') }}
                </th>
                <th scope="col" class="px-6 py-3 lg:table-cell">
                    {{ __('Pria') }}
                </th>
                <th scope="col" class="px-6 py-3 lg:table-cell">
                    {{ __('Wanita') }}
                </th>
                <th scope="col" class="px-6 py-3 lg:table-cell">
                    {{ __('Provinsi') }}
                </th>
                <th scope="col" class="px-6 py-3 lg:table-cell">
                    {{ __('Kabupaten') }}
                </th>
                <th scope="col" class="px-6 py-3 lg:table-cell">
                    {{ __('Tahun') }}
                </th>
                <th scope="col" class="px-6 py-3">
                    {{ __('Uraian') }}
                </th>
                <th scope="col" class="py-3 pl-6 pr-2 lg:pr-4">
                    {{ __('Option') }}
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse ($penyalurans as $penyaluran)
                <tr class="odd:bg-white odd:dark:bg-gray-800 even:bg-gray-100 even:dark:bg-gray-700">
                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-gray-200">
                        {{-- loop --}}
                        <div class="flex">
                            <div class="hover:underline whitespace-nowrap">
                                {{ ($penyalurans->currentpage() - 1) * $penyalurans->perpage() + $loop->index + 1 }}
                            </div>

                        </div>
                    </td>
                    <td scope="row" class="px-6 py-4 text-gray-500 font-base dark:text-gray-400 xl:table-cell">
                        <div class="flex">
                            <p>
                                {{ $penyaluran->tanggal->isoformat('LL') }}
                            </p>

                        </div>

                    </td>
                    <td class="px-6 py-4 lg:table-cell">
                        <div class="flex">
                            <p>
                                {{ $penyaluran->nominal }}
                            </p>

                        </div>
                    </td>
                    <td class="px-6 py-4 lg:table-cell">
                        <div class="flex">
                            <p>
                                {{ $penyaluran->programPilar->pilar->name ?? '-' }}
                            </p>
                        </div>
                    </td>
                    <td class="px-6 py-4 lg:table-cell">
                        <div class="flex">
                            <p>
                                {{ $penyaluran->programPilar->name ?? '-' }}
                            </p>
                        </div>
                    </td>
                    <td class="px-6 py-4 lg:table-cell">
                        <div class="flex">
                            <p>
                                {{ $penyaluran->ashnaf->name ?? '-' }}
                            </p>

                        </div>
                    </td>
                    <td class="px-6 py-4 lg:table-cell">
                        <div class="flex">
                            <p>
                                {{ $penyaluran->lembaga_count ?? '-' }}
                            </p>

                        </div>
                    </td>
                    <td class="px-6 py-4 lg:table-cell">
                        <div class="flex">
                            <p>
                                {{ $penyaluran->male_count ?? '-' }}
                            </p>

                        </div>
                    </td>
                    <td class="px-6 py-4 lg:table-cell">
                        <div class="flex">
                            <p>
                                {{ $penyaluran->female_count ?? '-' }}
                            </p>

                        </div>
                    </td>
                    <td class="px-6 py-4 lg:table-cell">
                        <div class="flex">
                            <p>
                                {{ $penyaluran->provinsi->name ?? '-' }}
                            </p>

                        </div>
                    </td>
                    <td class="px-6 py-4 lg:table-cell">
                        <div class="flex">
                            <p>
                                {{ $penyaluran->kabupaten->name ?? '-' }}
                            </p>

                        </div>
                    </td>
                    <td class="px-6 py-4 lg:table-cell">
                        <div class="flex">
                            <p>
                                {{ $penyaluran->tahun->name }}
                            </p>

                        </div>
                    </td>
                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-gray-200">
                        {{-- loop --}}
                        <div class="flex">
                            <a href="{{ route('penyaluran.show', $penyaluran) }}"
                                class="hover:underline whitespace-nowrap">
                                {{ $penyaluran->uraian }}
                            </a>

                        </div>
                    </td>
                    <td class="py-4 pl-6 pr-2 lg:pr-4">
                        <div class="flex space-x-2 justify-items-start">
                            <a href="{{ route('penyaluran.show', $penyaluran) }}" class="hover:underline">Lihat</a>
                            <a href="{{ route('penyaluran.edit', $penyaluran) }}"
                                class="text-indigo-500 hover:underline">Ubah</a>
                            <button x-data="" class="text-red-500 hover:underline"
                                x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion{{ $penyaluran->id }}')">
                                Hapus
                            </button>

                            <x-modal name="confirm-user-deletion{{ $penyaluran->id }}" :show="$errors->userDeletion->isNotEmpty()" focusable>
                                <form method="post" action="{{ route('penyaluran.destroy', $penyaluran) }}"
                                    class="p-6">
                                    @csrf
                                    @method('delete')

                                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                        Apakah anda yakin ingin menghapus data ini?
                                    </h2>

                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                        {{ $penyaluran->uraian }}
                                    </p>
                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                        {{ $penyaluran->tanggal->format('d F Y') }}
                                    </p>

                                    <div class="flex justify-end mt-6">
                                        <x-secondary-button x-on:click="$dispatch('close')">
                                            {{ __('Batal') }}
                                        </x-secondary-button>

                                        <x-danger-button class="ms-3">
                                            {{ __('Hapus') }}
                                        </x-danger-button>
                                    </div>
                                </form>
                            </x-modal>
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
