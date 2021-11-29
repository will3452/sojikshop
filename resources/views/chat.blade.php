<x-layout>
    <div class="h-screen w-full mx-auto md:w-1/2">
        <div style="height:70vh !important; overflow-y:auto;">
            @foreach ($messages as $message)
                @if ($message->sender_id === auth()->id())
                    <div class="my-4">
                        <div class="bg-blue-300 p-2 w-full" style="border-radius:20px 20px 0px 20px">
                            {{$message->content}}
                        </div>
                        <div class="text-xs font-bold text-gray-300">
                            {{$message->created_at->format('m-d-Y H:i a')}}
                        </div>
                    </div>
                @else
                    <div class="my-4">

                        <div class="bg-gray-300 p-2 w-full " style="border-radius:20px 20px 20px 0px">
                            {{$message->content}}
                        </div>
                        <div class="text-xs font-bold text-gray-300">
                            {{$message->created_at->format('m-d-Y h:i a')}}
                        </div>
                    </div>
                @endif
            @endforeach
            <div id="latest">
                <a class="mx-2 p-2 pl-0 rounded underline font-bold" href="{{url()->current()}}">refresh message</a>
            </div>
        </div>
        <form class="h-4/12 flex items-center" method="POST" action="/chat">
            @csrf
            <input type="hidden" name="receiver_id" value="{{$user->id}}"/>
            <textarea name="content" id="" class="w-full border rounded"></textarea>
            <div>
                <button class="mx-2 bg-green-200 p-2 rounded">send</button>
            </div>
        </form>
    </div>
</x-layout>
