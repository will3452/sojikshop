<x-layout>
    <div class="flex justify-center">
        <div class="m-4 shadow-xl w-full p-4 md:w-1/4">
            <h2 class="text-center text-xl text-purple-900 font-bold">
                Enter Your Email
            </h2>
            @if (session('error'))
                <x-error>
                    {{session('error')}}
                </x-error>
            @endif
            <form action="{{route('forgot.password')}}" method="POST">
                @csrf
                <x-input name="email" required placeholder="Enter your email here"></x-input>
                <button class="block bg-purple-900 text-white rounded-3xl font-bold w-full p-3 mt-4">
                    Send Password Reset Link
                </button>
            </form>
        </div>
    </div>
</x-layout>
