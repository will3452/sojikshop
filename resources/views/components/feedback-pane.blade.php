@props(['star'=>3, 'userimage'=>null, 'message'=>''])
<div class="shadow rounded-xl w-full p-4 my-4 relative">
    <img
    @if ($userimage)
    src="/storage/{{$userimage}}"
    @else
    src='https://cdn5.vectorstock.com/i/thumb-large/45/79/male-avatar-profile-picture-silhouette-light-vector-4684579.jpg'
    @endif
    class="w-20 h-20 rounded-full  shadow absolute -top-10" alt=""
    >

    <p class="text-right pt-8 text-sm text-gray-800 tracker-2">
        {{$message}}
    </p>
    <div>
        <div x-data="{star:{{$star}}}" class="my-2">
            <div>
                <span class="select-none material-icons cursor-pointer" :class="{'text-yellow-500':star >= 1}" >
                    grade
                </span>
                <span class="select-none material-icons cursor-pointer" :class="{'text-yellow-500':star >= 2}">
                    grade
                </span>
                <span class="select-none material-icons cursor-pointer" :class="{'text-yellow-500':star >= 3}" >
                    grade
                </span>
                <span class="select-none material-icons cursor-pointer" :class="{'text-yellow-500':star >= 4}" >
                    grade
                </span>
                <span class="select-none material-icons cursor-pointer" :class="{'text-yellow-500':star == 5}">
                    grade
                </span>
            </div>
        </div>
    </div>
</div>
