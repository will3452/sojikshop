<x-layout>
    <x-title>
        Write Feedback
    </x-title>
    <form action="{{url()->current()}}" class="px-2 md:w-1/2 mx-auto" method="POST">
        @csrf
        @foreach ($orderProducts as $orderProduct)
        <div class="flex items-center justify-between w-full rounded shadow px-2 mb-2">
            <img src="/storage/{{$orderProduct->product->image}}" alt="" class="w-20 h-20 ">
            <div class="text-right text-xs font-bold">
                {{$orderProduct->product->name}}
            </div>
            <input type="hidden" name="product_id[]" value="{{$orderProduct->product->id}}">
        </div>
        <div x-data="{star:4}" class="mb-4">
            <input type="hidden" name="star[]" x-bind:value="star">
            <div>
                <span class="select-none material-icons cursor-pointer" :class="{'text-yellow-500':star >= 1}" x-on:click="star=1">
                    grade
                </span>
                <span class="select-none material-icons cursor-pointer" :class="{'text-yellow-500':star >= 2}" x-on:click="star=2">
                    grade
                </span>
                <span class="select-none material-icons cursor-pointer" :class="{'text-yellow-500':star >= 3}" x-on:click="star=3">
                    grade
                </span>
                <span class="select-none material-icons cursor-pointer" :class="{'text-yellow-500':star >= 4}" x-on:click="star=4">
                    grade
                </span>
                <span class="select-none material-icons cursor-pointer" :class="{'text-yellow-500':star == 5}" x-on:click="star=5">
                    grade
                </span>

            </div>
        </div>
        <div class="mb-3 border-b-2 pb-3">
            <textarea name="message[]" required class="w-full border-2 border-pink-600 rounded p-2" placeholder="Please Write Feedback for {{$orderProduct->product->name}} here."></textarea>
        </div>
        @endforeach
        <button class="w-full text-center font-bold uppercase bg-purple-900 text-white rounded-3xl py-2 px-5">
            Submit
        </button>
    </form>
</x-layout>
