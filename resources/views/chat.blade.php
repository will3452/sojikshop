<x-layout>
    <div class="h-screen w-full mx-auto md:w-1/2">
        <div class="h-8/12">
            @foreach ($messages as $message)
                @if ($message->sender_id === auth()->id())
                    <div>
                        <div>
                            You
                        </div>
                        <div class="bg-blue-300 p-2 w-full mb-2" style="border-radius:20px 20px 0px 20px">
                            {{$message->content}}
                        </div>
                    </div>
                @else
                <div>
                    <div>
                        {{$message->sender->name}}
                    </div>
                    <div class="bg-gray-300 p-2 w-full mb-2" style="border-radius:20px 20px 20px 0px">
                        {{$message->content}}
                    </div>
                </div>
                @endif
            @endforeach
        </div>
        <form class="h-4/12 flex">
            <textarea name="" id="" cols="30" rows="10">

            </textarea>
            <button>send</button>
        </form>
    </div>
</x-layout>
