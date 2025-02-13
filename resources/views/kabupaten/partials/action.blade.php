<x-dropdown align="right" width="48">
    <x-slot name="trigger">
        <button
            class="inline-flex items-center text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out rounded-md dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z" />
            </svg>
        </button>
    </x-slot>

    <x-slot name="content">
        @if (request()->routeIs('kabupaten.index'))
            <x-dropdown-link :href="route('kabupaten.show', $kabupaten)">
                {{ __('View') }}
            </x-dropdown-link>
        @endif
        @unless (request()->routeIs('kabupaten.edit'))
            <x-dropdown-link :href="route('kabupaten.edit', $kabupaten)">
                {{ __('Edit') }}
            </x-dropdown-link>
        @endunless
        {{-- @if ($kabupaten->isUserVerified())
            @if ($kabupaten->isAdmin())
                <form action="{{ route('kabupaten.removeadmin', $kabupaten) }}" method="Post">
                    @csrf
                    @method('PATCH')
                    <x-dropdown-link :href="route('kabupaten.removeadmin', $kabupaten)" onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Remove Admin') }}
                    </x-dropdown-link>
                </form>
            @else
                <form action="{{ route('kabupaten.makeadmin', $kabupaten) }}" method="Post">
                    @csrf
                    @method('PATCH')
                    <x-dropdown-link :href="route('kabupaten.makeadmin', $kabupaten)" onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Make Admin') }}
                    </x-dropdown-link>
                </form>
            @endif
        @endif --}}
        {{-- @if ($kabupaten->isUserVerified())
            <form action="{{ route('kabupaten.unverify', $kabupaten) }}" method="Post">
                @csrf
                @method('PATCH')
                <x-dropdown-link :href="route('kabupaten.unverify', $kabupaten)" onclick="event.preventDefault(); this.closest('form').submit();">
                    {{ __('Unverify Account') }}
                </x-dropdown-link>
            </form>
        @else
            <form action="{{ route('kabupaten.verify', $kabupaten) }}" method="Post">
                @csrf
                @method('PATCH')
                <x-dropdown-link :href="route('kabupaten.verify', $kabupaten)" onclick="event.preventDefault(); this.closest('form').submit();">
                    {{ __('Verify Account') }}
                </x-dropdown-link>
            </form>
        @endif --}}
        <form action="{{ route('kabupaten.index', $kabupaten) }}" method="Post">
            @csrf
            @method('PATCH')
            <x-dropdown-link :href="route('kabupaten.index', $kabupaten)" onclick="event.preventDefault(); this.closest('form').submit();">
                {{ __('Reset Password') }}
            </x-dropdown-link>
        </form>
        <form action="{{ route('kabupaten.destroy', $kabupaten) }}" method="Post">
            @csrf
            @method('DELETE')
            <x-dropdown-link :href="route('kabupaten.destroy', $kabupaten)" onclick="event.preventDefault(); this.closest('form').submit();">
                {{ __('Delete Account') }}
            </x-dropdown-link>
        </form>
    </x-slot>
</x-dropdown>
