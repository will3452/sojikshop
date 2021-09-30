<x-layout>
    <div class="h-screen flex justify-center items-start bg-blue-100">
        <form
        method="POST"
        action="{{ route('login') }}"
        class="
        bg-white
        shadow-2xl
        rounded-2xl
        w-full
        mx-4
        p-8
        mt-5
        md:w-1/3
        ">
            @csrf
            <h2 class="text-center uppercase font-bold text-2xl text-pink-700">
                LOGIN NOW
            </h2>
            @if(session('error'))
            <x-error>
                {{session('error')}}
            </x-error>
            @endif

            <x-input name="email" required type="email" placeholder="Your Email"></x-input>
            <x-input name="password" type="password" required placeholder="Your Password"></x-input>
            <button
            class="
            mt-4
            p-2
            bg-purple-900
            text-white
            w-full
            rounded-3xl
            "
            >
            LOGIN NOW
            </button>
            <div class="text-center my-4 text-sm">
                or
            </div>
            <div class="flex justify-center">
                <a href="{{ route('register') }}" class="inline-block text-center text-purple-500 border-purple-500 pb-2 border-b-2 px-4">
                    CREATE AN ACCOUNT
                </a>
            </div>
            <a class="block text-sm text-gray-400 text-center mt-4 font-bold" href="{{route('forgot.password')}}">
                forgot password?
            </a>
        </form>

    </div>
</x-layout>
