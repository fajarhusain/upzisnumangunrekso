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
        @if (request()->routeIs('programsumber.index'))
            <x-dropdown-link :href="route('programsumber.show', $programSumber)">
                {{ __('View') }}
            </x-dropdown-link>
        @endif
        @unless (request()->routeIs('programsumber.edit'))
            <x-dropdown-link :href="route('programsumber.edit', $programSumber)">
                {{ __('Edit') }}
            </x-dropdown-link>
        @endunless
        {{-- @if ($programSumber->isUserVerified())
            @if ($programSumber->isAdmin())
                <form action="{{ route('programsumber.removeadmin', $programSumber) }}" method="Post">
                    @csrf
                    @method('PATCH')
                    <x-dropdown-link :href="route('programsumber.removeadmin', $programSumber)" onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Remove Admin') }}
                    </x-dropdown-link>
                </form>
            @else
                <form action="{{ route('programsumber.makeadmin', $programSumber) }}" method="Post">
                    @csrf
                    @method('PATCH')
                    <x-dropdown-link :href="route('programsumber.makeadmin', $programSumber)" onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Make Admin') }}
                    </x-dropdown-link>
                </form>
            @endif
        @endif --}}
        {{-- @if ($programSumber->isUserVerified())
            <form action="{{ route('programsumber.unverify', $programSumber) }}" method="Post">
                @csrf
                @method('PATCH')
                <x-dropdown-link :href="route('programsumber.unverify', $programSumber)" onclick="event.preventDefault(); this.closest('form').submit();">
                    {{ __('Unverify Account') }}
                </x-dropdown-link>
            </form>
        @else
            <form action="{{ route('programsumber.verify', $programSumber) }}" method="Post">
                @csrf
                @method('PATCH')
                <x-dropdown-link :href="route('programsumber.verify', $programSumber)" onclick="event.preventDefault(); this.closest('form').submit();">
                    {{ __('Verify Account') }}
                </x-dropdown-link>
            </form>
        @endif --}}
        <form action="{{ route('programsumber.index', $programSumber) }}" method="Post">
            @csrf
            @method('PATCH')
            <x-dropdown-link :href="route('programsumber.index', $programSumber)" onclick="event.preventDefault(); this.closest('form').submit();">
                {{ __('Reset Password') }}
            </x-dropdown-link>
        </form>
        <form action="{{ route('programsumber.destroy', $programSumber) }}" method="Post">
            @csrf
            @method('DELETE')
            <x-dropdown-link :href="route('programsumber.destroy', $programSumber)" onclick="event.preventDefault(); this.closest('form').submit();">
                {{ __('Delete Account') }}
            </x-dropdown-link>
        </form>
    </x-slot>
</x-dropdown>
