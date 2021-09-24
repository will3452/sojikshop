<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Welcome page</title>
    <link
      href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/icon?family=Material+Icons"
    />
  </head>
  <body class="">
    <!-- navbar -->
    <nav
      class="
        sticky
        top-0
        md:relative
        flex
        justify-between
        items-center
        p-2
        md:p-6
        bg-purple-500
      "
    >
      <div>
        <a href="">
          <span class="material-icons text-white"> polymer </span>
        </a>
      </div>
      <div>
        <a href="#" class="px-2">
          <span class="material-icons text-white"> favorite </span>
          <span
            class="inline-block h-2 bg-pink-500 text-white rounded-2xl p-1"
          ></span>
        </a>
        <a href="#" class="px-2">
          <span class="material-icons text-white"> shopping_cart </span>
          <span
            class="inline-block h-2 bg-pink-500 text-white rounded-2xl p-1"
          ></span>
        </a>
        <a href="#" class="px-2">
          <span class="material-icons text-white"> account_circle </span>
        </a>
      </div>
    </nav>
    <!-- end of navbar -->

    <!-- banner -->
    <div class="bg-red-200">
      <img
        src="/2xTFFq36ODb74FqMP6NVBG4lEUrAJeSBFRLOZS6p.png"
        alt=""
        class="h-60 md:h-96 w-full object-cover"
      />
    </div>
    <!-- end of banner -->

    <!-- searbar -->
    <form
      class="
        py-5
        md:py-8 md:bg-blue-200
        bg-pink-500
        flex
        items-center
        justify-center
      "
    >
      <input
        type="text"
        placeholder="K-Pop"
        class="
          placeholder-purple-500
          inline-block
          w-4/5
          md:w-2/5
          bg-white
          rounded-l-3xl
          py-3
          px-4
          text-lg
          border-2
          md:border-purple-200
        "
      />
      <button class="py-3 px-3 bg-purple-600 rounded-r-3xl">
        <span class="material-icons text-white"> search </span>
      </button>
    </form>
    <!-- end of searchbar -->

    <!-- Categories -->
    <div class="flex p-2 overflow-x-scroll">
      <div
        class="flex-none h-40 md:h-96 w-2/3 bg-red-200 rounded-lg mx-2"
      ></div>
      <div
        class="flex-none h-40 md:h-96 w-2/3 bg-red-200 rounded-lg mx-2"
      ></div>
      <div
        class="flex-none h-40 md:h-96 w-2/3 bg-red-200 rounded-lg mx-2"
      ></div>
    </div>
    <!-- end of categories -->
    <!-- title -->
    <h2
      class="
        text-center text-2xl
        py-4
        font-bold
        text-gray-900
        md:text-4xl md:py-10 md:font-thin
      "
    >
      NEW PRODUCTS
    </h2>
    <!-- end of title -->
    <!-- products -->

    <div class="flex flex-wrap justify-center">
      <div
        class="h-52 m-2 w-2/5 md:h-96 md:w-1/6 bg-white rounded-lg shadow-lg"
      ></div>
      <div
        class="h-52 m-2 w-2/5 md:h-96 md:w-1/6 bg-white rounded-lg shadow-lg"
      ></div>
      <div
        class="h-52 m-2 w-2/5 md:h-96 md:w-1/6 bg-white rounded-lg shadow-lg"
      ></div>
      <div
        class="h-52 m-2 w-2/5 md:h-96 md:w-1/6 bg-white rounded-lg shadow-lg"
      ></div>
      <div
        class="h-52 m-2 w-2/5 md:h-96 md:w-1/6 bg-white rounded-lg shadow-lg"
      ></div>
      <div
        class="h-52 m-2 w-2/5 md:h-96 md:w-1/6 bg-white rounded-lg shadow-lg"
      ></div>
      <div
        class="h-52 m-2 w-2/5 md:h-96 md:w-1/6 bg-white rounded-lg shadow-lg"
      ></div>
    </div>
    <!-- end of products -->

    <!-- Featured -->
    <div>
      <div class="bg-purple-700 text-center p-2 my-4 md:py-10">
        <h2 class="font-bold text-2xl text-white md:text-4xl md:font-thin">
          SOME TEXT HERE
        </h2>
        <p class="text-white md:text-2xl md:mt-2">
          Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sed quo in
          enim nisi neque ratione deserunt explicabo blanditiis vitae delectus!
        </p>
        <button
          class="
            my-4
            bg-pink-500
            text-white
            py-2
            px-4
            rounded-lg
            md:px-8 md:text-2xl md:py-4
          "
        >
          SHOP NOW
        </button>
      </div>
    </div>
    <!-- end of Featured -->

    <h2
      class="
        text-center text-2xl
        py-4
        font-bold
        text-gray-900
        md:text-4xl md:py-10 md:font-thin
      "
    >
      NEW PRODUCTS
    </h2>
    <!-- other products -->
    <div class="flex p-2 overflow-x-scroll">
      <div
        class="flex-none md:h-96 md:w-1/6 h-40 w-1/3 bg-red-200 rounded-lg mx-2"
      ></div>
      <div
        class="flex-none md:h-96 md:w-1/6 h-40 w-1/3 bg-red-200 rounded-lg mx-2"
      ></div>
      <div
        class="flex-none md:h-96 md:w-1/6 h-40 w-1/3 bg-red-200 rounded-lg mx-2"
      ></div>
      <div
        class="flex-none md:h-96 md:w-1/6 h-40 w-1/3 bg-red-200 rounded-lg mx-2"
      ></div>
      <div
        class="flex-none md:h-96 md:w-1/6 h-40 w-1/3 bg-red-200 rounded-lg mx-2"
      ></div>
      <div
        class="flex-none md:h-96 md:w-1/6 h-40 w-1/3 bg-red-200 rounded-lg mx-2"
      ></div>
      <div
        class="flex-none md:h-96 md:w-1/6 h-40 w-1/3 bg-red-200 rounded-lg mx-2"
      ></div>
    </div>
    <!-- end of other products -->
    <h2
      class="
        text-center text-2xl
        py-4
        font-bold
        text-gray-900
        md:text-4xl md:py-10 md:font-thin
      "
    >
      NEW PRODUCTS
    </h2>

    <!-- other products -->
    <div class="flex p-2 overflow-x-scroll">
      <div
        class="flex-none md:h-96 md:w-1/6 h-40 w-1/3 bg-red-200 rounded-lg mx-2"
      ></div>
      <div
        class="flex-none md:h-96 md:w-1/6 h-40 w-1/3 bg-red-200 rounded-lg mx-2"
      ></div>
      <div
        class="flex-none md:h-96 md:w-1/6 h-40 w-1/3 bg-red-200 rounded-lg mx-2"
      ></div>
      <div
        class="flex-none md:h-96 md:w-1/6 h-40 w-1/3 bg-red-200 rounded-lg mx-2"
      ></div>
      <div
        class="flex-none md:h-96 md:w-1/6 h-40 w-1/3 bg-red-200 rounded-lg mx-2"
      ></div>
      <div
        class="flex-none md:h-96 md:w-1/6 h-40 w-1/3 bg-red-200 rounded-lg mx-2"
      ></div>
      <div
        class="flex-none md:h-96 md:w-1/6 h-40 w-1/3 bg-red-200 rounded-lg mx-2"
      ></div>
    </div>
    <!-- end of other products -->

    <footer class="bg-purple-900 h-32 mt-4 p-4 text-center text-purple-200">
      Footer here
    </footer>
  </body>
</html>
