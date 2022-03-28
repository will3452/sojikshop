<x-layout>
    <form action="/check-code" class="p-4 w-full md:w-1/2 mx-auto" method="POST">
        @csrf
        <div class="font-bold text-xl text-gray-800">
            {{nova_get_setting('verification_notice_message') ?? 'Your Email Address must be verified. please Enter the 6 Pin Code that we sent to your registered Email.'}}
        </div>
       <div class="flex justify-around">
        @for ($i = 0; $i < 6; $i++)
        <input type="text" name="code[]" id="code{{$i+1}}" step="{{$i+1}}" maxlength="1" required class="codebox text-2xl font-bold text-center border-2 border-pink-600 p-2 mt-4 rounded block w-16">
        @endfor
       </div>
        <button class="mt-2 p-2 text-center bg-blue-900 text-blue-900 font-bold uppercase rounded-3xl w-full">Verify</button>
        <a class="block mt-4 text-center" href="/get-new-code">Get New Code?</a>
        <script>
            let tboxes = document.getElementsByClassName('codebox');
            for (let index = 0; index < tboxes.length; index++) {
                const element = tboxes[index];
                element.addEventListener('keydown', function(e){
                    e.preventDefault();
                    console.log(e.code);
                    if(e.code =='Backspace'){
                        tboxes[index - 1].focus();
                    }
                    if(e.code == "Backspace" || e.code == "CapsLock" || e.code == "Tab" || e.code == "ControlLeft" || e.code == "Alt"){
                        element.value = '';
                        return;
                    }else {
                        tboxes[index].value = e.key;
                        tboxes[index + 1].focus();
                    }

                })

            }

        </script>
    </form>
</x-layout>
