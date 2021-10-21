<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
      href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css"
      rel="stylesheet"
    />
</head>
<body class="m-4">
    <div style="max-width: 210mm;" class="mx-auto">
        <div class="flex">
            <img src="{{config('app.url')}}/storage/{{nova_get_setting('logo')}}" alt="logo" class="w-20" style="width:100px;"/>
        </div>
        <div class="flex mt-4 text-xs">
            <div class="w-1/2 border p-2 mx-2">
                <div class="font-bold uppercase">
                    Invoice For
                </div>
                <div>
                    {{$invoice->user->name}}
                </div>

            </div>
            <div class="w-1/2 border p-2 mx-2">
                <div class="font-bold uppercase">
                    Transaction #
                </div>
                <div>
                    {{$invoice->txnid}}
                </div>
                <div class="font-bold uppercase mt-4">
                    Date
                </div>
                <div>
                    {{$invoice->created_at->format('m/d/Y')}}
                </div>
            </div>
        </div>
        <table class="w-full mt-2 text-left border p-2">
            <thead>
                <tr>
                    <th class="text-purple-900 border p-1 mx-2">
                        Description
                    </th>
                    <th class="text-purple-900 border p-1 mx-2">
                        Quantity
                    </th>
                    <th class="text-purple-900 border p-1 mx-2">
                        Unit Price
                    </th>
                    <th class="text-purple-900 border p-1 mx-2">
                        Total Price
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach (json_decode($invoice->items)->products as $item)
                <tr>
                    <td class="border p-1 mx-2">
                        {{$item->name}}
                    </td>
                    <td class="border p-1 mx-2">
                        {{$item->quantity}}
                    </td>
                    <td class="border p-1 mx-2">
                        {{$item->price}}
                    </td>
                    <td class="border p-1 mx-2">
                        {{$item->price * $item->quantity}}
                    </td>
                </tr>
                @endforeach
                <tr>
                    <th></th>
                    <th></th>
                    <th>
                        Shipping
                    </th>
                    <th>
                        {{json_decode($invoice->items)->summary->shipping_fee}}
                    </th>
                </tr>
                <tr>
                    <th></th>
                    <th></th>
                    <th>
                        Total
                    </th>
                    <th>
                        {{json_decode($invoice->items)->summary->total}}
                    </th>
                </tr>
                <tr>
                    <th></th>
                    <th></th>
                    <th>
                        Grand Total
                    </th>
                    <th>
                        {{json_decode($invoice->items)->summary->grand_total}}
                    </th>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
