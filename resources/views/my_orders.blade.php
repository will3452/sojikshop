<x-layout>
    <x-title>
        Orders
    </x-title>
    <div class="w-full px-4 mx-auto relative mt-5 md:w-1/2 ">
        <div id="line" class="w-full h-1 bg-gradient-to-r from-pink-500 to-purple-900 rounded">
        </div>
        <div class="flex w-full relative -top-5 justify-between">
            <a x-data="{isHover:false}" x-on:mouseover="isHover=true"x-on:mouseleave="isHover=false" href="{{route('my-orders')}}?active=pre-order" class="relative md:h-12 md:w-12 active block w-8 h-8 border-2 border-purple-900 {{request()->active!= 'pre-order'? 'bg-white':'bg-purple-900'}} rounded-full flex items-center justify-center flex-col">
                <span class="material-icons {{request()->active!= 'pre-order'? 'text-purple-900':'text-white'}}" style="font-size:16px;">
                pending
                </span>
                <span x-show="isHover" class="uppercase text-xs font-bold absolute -top-5 text-purple-900">
                    preorder
                </span>
            </a>

            <a x-data="{isHover:false}" x-on:mouseover="isHover=true"x-on:mouseleave="isHover=false" href="{{route('my-orders')}}?active=packaging" class="relative md:h-12 md:w-12 active block w-8 h-8 border-2 border-purple-900 {{request()->active!= 'packaging'? 'bg-white':'bg-purple-900'}} rounded-full flex items-center justify-center flex-col">
                <span class="material-icons {{request()->active!= 'packaging'? 'text-purple-900':'text-white'}}" style="font-size:16px;">
                inventory_2
                </span>
                <span x-show="isHover" class="uppercase text-xs font-bold absolute -top-5 text-purple-900">
                    packaging
                </span>
            </a>

            <a x-data="{isHover:false}" x-on:mouseover="isHover=true"x-on:mouseleave="isHover=false" href="{{route('my-orders')}}?active=delivery" class="md:h-12 md:w-12 active block w-8 h-8 border-2 border-purple-900 {{request()->active!= 'delivery' ? 'bg-white':'bg-purple-900'}} rounded-full flex items-center justify-center">
                <span class="material-icons {{request()->active!= 'delivery' ? 'text-purple-900':'text-white'}}" style="font-size:16px;">
                local_shipping
                </span>
                <span x-show="isHover" class="uppercase text-xs font-bold absolute -top-5 text-purple-900">
                    Delivery
                </span>
            </a>

            <a x-data="{isHover:false}" x-on:mouseover="isHover=true"x-on:mouseleave="isHover=false" href="{{route('my-orders')}}?active=feedback" class="md:h-12 md:w-12 active block w-8 h-8 border-2 border-purple-900 {{request()->active!= 'feedback' ? 'bg-white':'bg-purple-900'}} rounded-full flex items-center justify-center">
                <span class="material-icons {{request()->active!= 'feedback' ? 'text-purple-900':'text-white'}}" style="font-size:16px;">
                question_answer
                </span>
                <span x-show="isHover" class="uppercase text-xs font-bold absolute -top-5 text-purple-900">
                    Feedback
                </span>
            </a>
        </div>
        {{-- list of orders--}}
        <ul>
            @forelse ($orders as $order)
                <li class="shadow-lg p-2 py-4 rounded-lg " x-data="{isShow:false}">
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="font-bold text-purple-900">
                                {{$order->reference_number}}
                            </span>
                            <div class="text-xs text-gray-600">
                                {{$order->created_at->format('m-d-Y H:i A')}}
                            </div>
                        </div>
                        <a href="#" class="uppercase text-xs p-1 px-2  flex " x-show="!isShow" x-on:click.prevent="isShow=true">
                            <span class="material-icons text-gray-600">
                                expand_more
                            </span>
                        </a>
                        <a href="#" class="uppercase text-xs p-1 px-2  flex " x-show="isShow" x-on:click.prevent.away="isShow=false">
                            <span class="material-icons text-gray-600">
                                expand_less
                            </span>
                        </a>
                    </div>
                    <div class="mt-2" x-show="isShow">
                        <span class="font-bold text-xs text-gray-600">[Order Details]</span>
                        @foreach ($order->orderProducts as $orderProduct)
                            <div class="flex justify-between text-xs mt-2 border-b-2 p-2">
                                <span class="pr-2">
                                   {{$orderProduct->quantity}} - {{$orderProduct->product->name}}
                                </span>
                                <div class="font-bold flex-none">
                                    <span style="font-size: 8px;">PHP</span> {{number_format($orderProduct->amount,2)}}
                                </div>
                            </div>
                        @endforeach
                        <a
                        href="{{url('invoices', ['invoice'=>$order->invoice->id])}}"
                        class="text-xs uppercase font-bold p-2 block bg-gradient-to-r from-pink-500 to-purple-900 text-white text-center mt-2 rounded">
                            view invoice
                        </a>
                        @if ($order->status == \App\Models\Order::STATUS_FEEDBACK)
                        <a
                        href="/write-feedback/{{$order->id}}"
                        class="text-xs border-2 border-purple-900 uppercase font-bold p-2 block bg-white text-purple-900 text-center mt-2 rounded">
                            Write Feedback
                        </a>
                        @endif
                    </div>
                </li>
            @empty
                <li class="h-60 flex justify-center items-center flex-col text-center text-gray-500 uppercase">
                    <div class="mb-4">
                        No order found
                    </div>
                    <a class="block text-sm mt-2 px-3 py-2 bg-purple-900 text-white w-1/2 mx-auto rounded-lg" href="/">SHOP NOW</a>
                <li>
            @endforelse
        </ul>
</x-layout>
