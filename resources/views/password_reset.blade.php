<x-layout>
    <div class="flex justify-center">
        <div class="m-4 shadow-xl w-full p-4 md:w-1/4">
            <h2 class="text-center text-xl text-blue-900 font-bold">
                Enter Your Email
            </h2>
            @if (session('error'))
                <x-error>
                    {{session('error')}}
                </x-error>
            @endif
            <form action="{{route('password.reset')}}" method="POST">
                @csrf
                <x-input name="email" required placeholder="Enter your email here"></x-input>
                <x-input name="password" type="password" required placeholder="New Password"></x-input>
                <x-input name="password_confirmation" type="password" required placeholder="Confirm New Password"></x-input>
                <button class="block bg-blue-900 text-blue-900 rounded-3xl font-bold w-full p-3 mt-4">
                    Update Password
                </button>
            </form>
        </div>
    </div>
</x-layout>
