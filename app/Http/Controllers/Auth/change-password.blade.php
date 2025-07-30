<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Change Password
        </h2>
    </x-slot>

    <div class="py-12 max-w-4xl mx-auto">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            @if (session('status'))
                <div class="text-green-600 mb-4">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <div>
                    <x-input-label for="current_password" value="Current Password" />
                    <x-text-input type="password" name="current_password" id="current_password" class="mt-1 block w-full" required />
                    <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="new_password" value="New Password" />
                    <x-text-input type="password" name="new_password" id="new_password" class="mt-1 block w-full" required />
                    <x-input-error :messages="$errors->get('new_password')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="new_password_confirmation" value="Confirm New Password" />
                    <x-text-input type="password" name="new_password_confirmation" id="new_password_confirmation" class="mt-1 block w-full" required />
                </div>

                <div class="mt-6">
                    <x-primary-button>
                        Update Password
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
