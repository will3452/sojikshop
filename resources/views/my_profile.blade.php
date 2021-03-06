<x-layout>
    <div class="w-full p-2">
        <div class="flex items-center flex-col">
            @if (auth()->user()->image)
                <img class="object-fit w-24 h-24 rounded-full md:w-32 md:h-32" src="/storage/{{auth()->user()->image}}" alt="">
            @else
                <img class="object-fit w-24 h-24 rounded-full md:w-32 md:h-32" src="https://cdn5.vectorstock.com/i/thumb-large/45/79/male-avatar-profile-picture-silhouette-light-vector-4684579.jpg" alt="">
            @endif
            <div class="ml-1 text-xs w-full md:w-1/2"  x-data="{editable:false}">
                {{-- toggle --}}
                <div class="flex items-center">
                    <div class="mr-2 font-bold text-gray-500 uppercase">
                        Edit Mode
                    </div>
                    <div x-bind:class="{'bg-pink-300':editable}" class="w-10 h-5 rounded-3xl bg-gray-300 cursor-pointer relative" x-on:click="editable=!editable">
                        <div class="w-5 h-5 rounded-full bg-gray-900 absolute" x-bind:class="{'hidden':editable}">
                        </div>
                        <div class="w-5 h-5 rounded-full bg-green-200 text-blue-900 absolute right-0" x-bind:class="{'hidden':!editable}">
                        </div>
                    </div>
                </div>
                {{-- end of toggle --}}

                <template x-if="!editable">
                    <div>
                        <ul class="mt-10">
                            <li class="flex justify-between p-2 rounded shadow mb-2">
                                Name
                                <span class="font-bold">
                                    {{auth()->user()->name}}
                                </span>
                            </li>
                            <li class="flex justify-between p-2 rounded shadow mb-2">
                                Email
                                <span class="font-bold">
                                    {{auth()->user()->email}}
                                </span>
                            </li>
                            <li class="flex justify-between p-2 rounded shadow mb-2">
                                Mobile No.
                                <span class="font-bold">
                                    {{auth()->user()->mobile}}
                                </span>
                            </li>
                            <li class="flex justify-between p-2 rounded shadow mb-2">
                                Picture
                                <span>
                                    {{auth()->user()->image ?? '--'}}
                                </span>
                            </li>
                        </ul>
                        <div class="mt-4">
                            <div class="flex justify-between">
                                <h2 class="font-bold uppercase">Address</h2>
                                <a href="/add-new-address" class="uppercase underline text-pink-500">Add Address</a>
                            </div>
                            <div>
                                @foreach (auth()->user()->addresses as $address)
                                    <li class="flex justify-between p-2 rounded shadow w-full mt-2">
                                        <div class="flex items-center">
                                            <div>
                                                {{$address->inline_address}}
                                            </div>
                                            @if ($address->is_default)
                                                <div class="p-1 bg-gray-100 rounded ml-2 text-xs font-bold uppercase text-gray-500">
                                                    Default
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex">
                                            @if (!$address->is_default)
                                            <form action="/set-default-address/{{$address->id}}" method="POST">
                                                @csrf
                                                <button class="text-blue-900 bg-green-200 rounded p-1">set as default</button>
                                            </form>
                                            @endif
                                            <form class="ml-2" action="/delete-address/{{$address->id}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="text-blue-900 bg-red-500 rounded p-1">remove</button>
                                            </form>
                                        </div>
                                    </li>
                                @endforeach

                                @if (auth()->user()->addresses->isEmpty())
                                    <div class="flex justify-center items-center w-full bg-green-200 rounded h-20 mt-2">
                                        <div class="uppercase font-bold text-green-500">
                                            Empty
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </template>
                <template x-if="editable">
                    <form action="{{url()->current()}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="" class="block font-bold text-sm text-gray-900">
                                Name
                            </label>
                            <input type="text" value="{{auth()->user()->name}}" required name="name" class="mt-2 w-full p-2 rounded border-2 border-pink-600">
                        </div>

                        <div class="mb-4">
                            <label for="" class="block font-bold text-sm text-gray-900">
                                Email
                            </label>
                            <input type="email" value="{{auth()->user()->email}}" readonly  class="mt-2 w-full p-2 rounded border-2 border-pink-600">
                        </div>

                        <div class="mb-4">
                            <label for="" class="block font-bold text-sm text-gray-900">
                                Password
                            </label>
                            <input type="password" value="" name="password"  class="mt-2 w-full p-2 rounded border-2 border-pink-600">
                        </div>

                        <div class="mb-4">
                            <label for="" class="block font-bold text-sm text-gray-900">
                                Mobile No.
                            </label>
                            <input type="text" value="{{auth()->user()->mobile}}" required name="mobile" class="mt-2 w-full p-2 rounded border-2 border-pink-600">
                        </div>

                        <div class="mb-4">
                            <label for="" class="block font-bold text-sm text-gray-900">
                                Picture
                            </label>
                            <input type="file" value="{{auth()->user()->image}}" name="picture" class="mt-2 w-full p-2 rounded border-2 border-pink-600">
                        </div>
                        <button class="bg-green-200 text-green-900rounded px-2 py-1">Save</button>
                    </form>
                </template>
            </div>
        </div>
    </div>
</x-layout>
