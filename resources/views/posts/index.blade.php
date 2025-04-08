<x-app-layout>
    <div class="flex flex-row max-w-3xl gap-8 mx-auto">
        {{-- left side --}}
        @livewire('post-list' )
        {{-- rihgt side --}}
        <div class="hidden w-[60rem] lg:flex lg:flex-col pt-4 ">
            <div class="flex flex-row text-sm">
                <div class="ltr:mr-5 rtl:ml-5">
                    <a href="/u/{{auth()->user()->username}}">
                        <img src="{{Str::startsWith(auth()->user()->image, 'http')? auth()->user()->image : asset('storage/' . auth()->user()->image)}}" alt="{{auth()->user()->username}}" class="border border-gray-300 rounded-full h-12 w-12">
                    </a>
                </div>
                <div class="flex flex-col">
                    <a href="/u/{{auth()->user()->username}}" class="font-bold">
                        {{auth()->user()->username}}
                    </a>
                    <div class="text-gray-500 text-sm">
                        {{auth()->user()->name}}
                    </div>
                </div>
            </div>
            <div class="mt-5">
                <h3 class="font-bold text-gray-500">{{__("Suggestion for you")}}</h3>
                <ul>
                    @foreach ($suggested_users as $suggested_user)
                    <li class="flex flex-row my-5 text-sm justify-items-center">
                        <div class="ltr:mr-5 rtl:ml-5">
                            <a href="/u/{{$suggested_user->username}}">
                                <img src="{{Str::startsWith($suggested_user->image, 'http')? $suggested_user->image : asset('storage/' . $suggested_user->image)}}" class="rounded-full h-9 w-9 border border-gray-300">
                            </a>
                        </div>
                        <div class="flex flex-col grow">
                            <a href="/u/{{$suggested_user->username}}" class="font-bold">{{$suggested_user->username}}
                                
                                @livewire('follower-state', ['userId' => $suggested_user->id])
                            </a>
                            <div class="text-gray-500 text-sm">{{$suggested_user->name}}</div>
                        </div>
                        @if (auth()->user()->isPending($suggested_user))
                            <span class="text-gray-500 font-bold">{{__("Pending")}}</span>
                        @else
                        @livewire('follow-button', [ "userId" =>$suggested_user->id, "classes" => "text-blue-500"])
                        @endif           
                    </li>
                        
                    @endforeach
                </ul>
            </div>
            
        </div>
    </div>
</x-app-layout>