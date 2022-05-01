<x-layout>
    <div class="h-screen flex justify-center items-start bg-blue-100">
        <form
        action="{{ route('register') }}"
        method="POST"
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
            <h2 class="text-center uppercase font-bold text-2xl text-blue-700">
                Register now
            </h2>
            <x-input name="name" required placeholder="Enter your Name"></x-input>

            <x-input name="mobile" type="number" required placeholder="Enter your mobile"></x-input>

            <x-input name="email" type="email" required placeholder="Enter your Email"></x-input>

            <x-input name="password" type="password" required placeholder="Enter your Password"></x-input>

            <x-input name="password_confirmation" type="password" required placeholder="Confirm your Password"></x-input>

            <button
            class="
            mt-4
            p-2
            bg-pink-600
            text-white
            w-full
            rounded-3xl
            "
            >
            REGISTER NOW
            </button>
            <div class="text-center my-4 text-sm">
                or
            </div>
            <div class="flex justify-center">
                <a href="{{ route('login') }}" class="inline-block text-center text-blue-500 border-blue-500 pb-2 border-b-2 px-4">
                    LOGIN
                </a>
            </div>
        </form>
    </div>
</x-layout>
