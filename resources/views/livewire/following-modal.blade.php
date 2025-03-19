<div class="max-h-96 flex flex-col">
    <div class="flex border-b border-b-neutral-100 w-full items-center p-2">
        <h1 class="text-large font-bold text-center pb-2 grow">{{__("Following")}}</h1>
        <button wire:click="$dispatch('closeModal')">
            <i class="bx bx-x text-xl"></i>
        </button>
    </div>
    <ul class="overflow-y-auto">
        @forelse ($this->following_list as $following)
            <li class="flex flex-row w-full p-3 items-center text-sm">
                <div>
                    <img src="{{Str::startsWith($following->image, 'http') ? $following->image : asset("storage/" . $following->image)}}" class="w-8 h-8 mr-2 border border-neutral-300 rounded-full" alt="{{$following->username}}">
                </div>
                <div class="flex flex-col grow">
                    <div class="font-bold">
                        <a href="{{$following->username}}">{{$following->username}}</a>
                    </div>
                    <div class="text-sm text-neutral-500">
                        {{$following->name}}
                    </div>
                </div>
                @auth
                @if (auth()->user()->id == $userId)
                <button class="border border-gray-500 px-2 py-1 rounded" wire:click="unfollowing({{$following->id}})">{{__("Unfollow")}}</button>
                @endif
                    
                @endauth
            </li>
        @empty
            <li class="w-full p-3 text-center">
                {{__("You are not following any one.")}}
            </li>
        @endforelse
    </ul>
</div>
