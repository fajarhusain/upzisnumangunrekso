<div class="relative mt-6 overflow-x-visible overflow-y-visible rounded-md md:block">
    <table class="w-full text-base text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    {{ __('No.') }}
                </th>
                <th scope="col" class="px-6 py-3 lg:table-cell">
                    {{ __('Name') }}
                </th>
                <th scope="col" class="px-6 py-3 lg:table-cell">
                    {{ __('email') }}
                </th>
                <th scope="col" class="px-6 py-3 lg:table-cell">
                    {{ __('Role') }}
                </th>
                <th scope="col" class="py-3 pl-6 pr-2 text-center lg:pr-4">
                    {{ __('Option') }}
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr class="odd:bg-white odd:dark:bg-gray-800 even:bg-gray-100 even:dark:bg-gray-700">
                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-gray-200">
                        {{-- loop --}}
                        <div class="flex">
                            <div class="hover:underline whitespace-nowrap">
                                <p>
                                    {{ $loop->iteration }}
                                </p>
                            </div>
                        </div>
                    </td>

                    <td class="px-6 py-4 lg:table-cell">
                        <div class="flex">
                            <p>
                                {{ $user->name }}
                            </p>
                        </div>
                    </td>
                    <td class="px-6 py-4 lg:table-cell">
                        <div class="flex">
                            <p>
                                {{ $user->email ?? '-' }}
                            </p>
                        </div>
                    </td>
                    <td class="px-6 py-4 lg:table-cell">
                        <div class="flex">
                            <p>
                                {{ $user->role ?? '-' }}
                            </p>
                        </div>
                    </td>
                    <td class="py-4 pl-6 pr-2 text-center lg:pr-4">
                        <div class="flex justify-center space-x-2">
                            <a href="{{ route('user.edit', $user) }}" class="text-indigo-500 hover:underline">Edit</a>
                            <button x-data="" class="text-red-500 hover:underline"
                                x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion{{ $user->id }}')">
                                Hapus
                            </button>

                            <x-modal name="confirm-user-deletion{{ $user->id }}" :show="$errors->userDeletion->isNotEmpty()" focusable>
                                <form method="post" action="{{ route('user.destroy', $user) }}"
                                    class="p-6">
                                    @csrf
                                    @method('delete')

                                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                        Apakah anda yakin ingin menghapus akun ini?
                                    </h2>

                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                        {{ $user->name }}
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
