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
        @if (request()->routeIs('pilar.index'))
            <x-dropdown-link :href="route('pilar.show', $pilar)">
                {{ __('View') }}
            </x-dropdown-link>
        @endif
        @unless (request()->routeIs('pilar.edit'))
            <x-dropdown-link :href="route('pilar.edit', $pilar)">
                {{ __('Edit') }}
            </x-dropdown-link>
        @endunless
        {{-- @if ($pilar->isUserVerified())
            @if ($pilar->isAdmin())
                <form action="{{ route('pilar.removeadmin', $pilar) }}" method="Post">
                    @csrf
                    @method('PATCH')
                    <x-dropdown-link :href="route('pilar.removeadmin', $pilar)" onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Remove Admin') }}
                    </x-dropdown-link>
                </form>
            @else
                <form action="{{ route('pilar.makeadmin', $pilar) }}" method="Post">
                    @csrf
                    @method('PATCH')
                    <x-dropdown-link :href="route('pilar.makeadmin', $pilar)" onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Make Admin') }}
                    </x-dropdown-link>
                </form>
            @endif
        @endif --}}
        {{-- @if ($pilar->isUserVerified())
            <form action="{{ route('pilar.unverify', $pilar) }}" method="Post">
                @csrf
                @method('PATCH')
                <x-dropdown-link :href="route('pilar.unverify', $pilar)" onclick="event.preventDefault(); this.closest('form').submit();">
                    {{ __('Unverify Account') }}
                </x-dropdown-link>
            </form>
        @else
            <form action="{{ route('pilar.verify', $pilar) }}" method="Post">
                @csrf
                @method('PATCH')
                <x-dropdown-link :href="route('pilar.verify', $pilar)" onclick="event.preventDefault(); this.closest('form').submit();">
                    {{ __('Verify Account') }}
                </x-dropdown-link>
            </form>
        @endif --}}
        <form action="{{ route('pilar.index', $pilar) }}" method="Post">
            @csrf
            @method('PATCH')
            <x-dropdown-link :href="route('pilar.index', $pilar)" onclick="event.preventDefault(); this.closest('form').submit();">
                {{ __('Reset Password') }}
            </x-dropdown-link>
        </form>
        <form action="{{ route('pilar.destroy', $pilar) }}" method="Post">
            @csrf
            @method('DELETE')
            <x-dropdown-link :href="route('pilar.destroy', $pilar)" onclick="event.preventDefault(); this.closest('form').submit();">
                {{ __('Delete Account') }}
            </x-dropdown-link>
        </form>
    </x-slot>
</x-dropdown>
