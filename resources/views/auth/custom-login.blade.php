<x-filament::layouts.base>
    <div class="w-screen h-screen flex items-center justify-center bg-gray-100">
        <form method="POST" action="{{ route('filament.auth.login') }}" class="space-y-4 bg-white p-6 rounded shadow-md w-full max-w-sm">
            @csrf

            <h2 class="text-center text-xl font-semibold">Login Admin RT</h2>

            <x-filament::input.wrapper>
                <x-filament::input.label for="email" :value="'Email'" />
                <x-filament::input id="email" type="email" name="email" required autofocus />
            </x-filament::input.wrapper>

            <x-filament::input.wrapper>
                <x-filament::input.label for="password" :value="'Password'" />
                <x-filament::input id="password" type="password" name="password" required />
            </x-filament::input.wrapper>

            <x-filament::button type="submit" class="w-full justify-center">Login</x-filament::button>
        </form>
    </div>
</x-filament::layouts.base>