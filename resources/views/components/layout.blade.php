<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{config('app.name')}}</title>
    <link
      href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/icon?family=Material+Icons"
    />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/2.3.0/alpine.js" integrity="sha512-nIwdJlD5/vHj23CbO2iHCXtsqzdTTx3e3uAmpTm4x2Y8xCIFyWu4cSIV8GaGe2UNVq86/1h9EgUZy7tn243qdA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="icon"
      type="image/png"
      href="/storage/{{nova_get_setting('favicon', nova_get_setting('logo'))}}">
    <style>
        #main_content {
            visibility: hidden;
            transition: visibility 500ms;
        }
    </style>
</head>
  <body class="">
      @auth
          @if (auth()->user()->addresses()->count() == 0 && (url()->current() !== route('profile') || url()->current() !== 'https://sojikshop.store/public/verification-notice' || url()->current() !=='https://sojikshop.store/verification-notice'))
            <script>
               alert('Please setup your default address first.');
               window.location.href = '/profile/';
               //
            </script>
          @endif
      @endauth
      <div id="loader" class="w-screen h-screen flex items-center justify-center bg-pink-200 fixed">
          <div class="animate-spin w-10 h-10 border-4 rounded-full border-green-500" style="border-top-color: transparent;"></div>
      </div>
    <x-goto-top></x-goto-top>
    @include('sweetalert::alert')
    <div id="main_content">
        <x-navbar></x-navbar>
        {{ $slot }}
        {{-- <script>
            {
                const back2Top = document.querySelector('#back2Top');

                window.onscroll = function(){
                    if(window.scrollY <= 17){
                        back2Top.classList.add('hidden');
                    }else {
                        back2Top.classList.remove('hidden');
                    }
                }

                back2Top.addEventListener('click', (e) => {
                    e.preventDefault();
                    window.scroll({ top:0, left:0, behavior: 'smooth'});
                });
            }
        </script> --}}
    </div>

    <script>
        window.onload = function(){
            document.getElementById('loader').style.display = 'none';
            document.getElementById('main_content').style.visibility = 'visible';
        }
    </script>

  </body>
</html>
