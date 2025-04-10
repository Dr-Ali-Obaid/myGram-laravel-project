@php
use Illuminate\Support\Str;
@endphp

<x-app-layout>
    <div {{session("success")? '' : "hidden"}} class="w-50 p4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg absolute ltr:right-10 rtl:left-10 shadow shadow-neutral-200" role="alert">
        <span class="font-medium">{{session("success")}}</span>
    </div>
    {{-- upper section --}}
    <div class="grid grid-cols-4">
        {{-- user image --}}
        <div class="px-4 col-span-1 order-1">
            <img src="{{Str::startsWith($user->image, 'http') ? $user->image : Storage::url($user->image)}}" alt="{{$user->username}} profile picture"
            class="rounded-full w-20 h-20 md:w-40 md:h-40 border border-neutral-300">
        </div>
        {{-- username and buttons --}}
        <div class="px-4 col-span-2 md:col-span-3 order-2 flex flex-row items-center md:ltr:ml-0 md:rtl:mr-0">
            <div class="text-3xl mb-3">{{$user->username}}</div>
          <div class="ltr:mr-3 rtl:ml-3">
            @auth
            @if ($user->id === auth()->id())
            <a href="/u/{{$user->username}}/edit" 
                class="w-50 border border-neutral-300 text-sm text-center font-bold px-5 py-1 rounded-md md:rtl:mr-5 md:ltr:ml-5">
                {{__("Edit Profile")}}
            </a> 
            @else
            @livewire('follow-button', ['userId' => $user->id, "classes" => "bg-blue-500 text-white rtl:mr-4"])
            @endif
           
            @endauth
            @guest
            <a href="/u/{{$user->username}}/follow" class="w-30 bg-blue-400 text-white px-3 py-1 rounded text-center self-start">{{__("follow")}}</a>
            @endguest
          </div>
        </div>
        {{-- user info --}}
        <div class="text-md col-start-1 mt-8 px-4 order-3 md:col-start-2 md:order-4 md:mt-0">
            <p class="font-bold">{{$user->name}}</p>
            {!!
                nl2br(e($user->bio))
            !!}
        </div>
        {{-- user statics --}}
        <div class="col-span-4 my-4 py-2  border-y border-y-neutral-200 md:border-none order-4 md:order-3 md:col-start-2 md:px-4">
            <ul class="text-md flex flex-row justify-around md:justify-start md:space-x-10 md:text-xl">
                @livewire('posts-count', ['user' => $user])
                @livewire('follower', ['userId' => $user->id])
                @livewire('following', ['userId' => $user->id])
            </ul>
        </div>
    </div>
    {{-- bottom section --}}
    @livewire('profile-posts', ['user' => $user])
    
</x-app-layout>