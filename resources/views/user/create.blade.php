<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('User') }}
        </h2>
    </x-slot>

    <div class="sm:py-6">
        <div class="max-w-full mx-auto sm:px-6 sm:space-y-6">
            <x-card.app>
                <x-card.title>
                    {{ __('Create Data User') }}
                </x-card.title>
                <x-card.description>
                    {{ __('Create a new User.') }}
                </x-card.description>
                <div class="max-w-xl">
                    <form method="post" action="{{ route('user.store') }}" class="mt-6 space-y-6">
                        @csrf
                        @method('post')
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" name="name" type="text" class="block w-full mt-1"
                                :value="old('name')" required autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                        <div>
                            <x-input-label for="email" :value="__('email')" />
                            <x-text-input id="email" name="email" type="text" class="block w-full mt-1"
                                :value="old('email')" required autocomplete="username" />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>
                        <div>
                            <x-input-label for="role" :value="__('Role')" />
                            <x-select-input id="role" name="role" class="block w-full mt-1">
                                <option value="">{{ __('Select Role') }}</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->value }}">
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </x-select-input>
                            <x-input-error class="mt-2" :messages="$errors->get('role')" />
                        </div>
                        <div>
                            <x-input-label for="password" :value="__('Password')" />
                            <x-text-input id="password" name="password" type="password" class="block w-full mt-1"
                                :value="old('password')" required autocomplete="new_password" />
                            <x-input-error class="mt-2" :messages="$errors->get('password')" />
                        </div>
                        <div>
                            <x-input-label for="password confirm" :value="__('Password confirm')" />
                            <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                                class="block w-full mt-1" :value="old('password confirm')" required autocomplete="password_confirm" />
                            <x-input-error class="mt-2" :messages="$errors->get('password_confirmation')" />
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
