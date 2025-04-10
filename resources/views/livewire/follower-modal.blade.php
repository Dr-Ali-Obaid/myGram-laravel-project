<div class="max-h-96 flex flex-col">
    <div class="flex border-b border-b-neutral-100 w-full items-center p-2">
       
        <button wire:click="$dispatch('closeModal')">
            <i class="bx bx-x text-xl"></i>
        </button>
    </div>
    <ul class="overflow-y-auto">
        @forelse ($this->followerlist() as $follower)
            <li class="flex flex-row w-full p-3 items-center text-sm">
                <div>
                    <img src="{{ Str::startsWith($follower->image, 'http') ? $follower->image : Storage::url($follower->image) }}" class="w-8 h-8 mr-2 border border-neutral-300 rounded-full" alt="{{$follower->username}}">
                </div>
                <div class="flex flex-col grow">
                    <div class="font-bold">
                        <a href="{{$follower->username}}">{{$follower->username}}</a>
                    </div>
                    <div class="text-sm text-neutral-500">
                        {{$follower->name}}
                    </div>
                </div>
            </li>
        @empty
            <li class="w-full p-3 text-center">
                {{__("You are not followed by any one.")}}
            </li>
        @endforelse
    </ul>
</div>
