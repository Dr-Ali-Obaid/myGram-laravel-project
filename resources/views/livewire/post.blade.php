<div class="card">
    {{-- card header --}}
    <div class="card-header">
        
        <img src="{{Str::startsWith($post->owner->image, 'http')? $post->owner->image : Storage::url($post->owner->image)}}" alt="" class="w-9 h-9 ltr:mr-2 rtl:ml-2 rounded-full">
        <a href="/u/{{$post->owner->username}}" class="font-bold">{{$post->owner->username}}</a>
    </div>
    {{-- card body --}}
    <div class="card-body">
        <div class="max-h-[35rem] overflow-hidden">
            <img src="{{ Storage::url($post->image) }}" alt="{{$post->description}}" class="h-auto w-full object-cover">
        </div>
        <div class="p-3 flex flex-row">
        @livewire('like', ['post' => $post])
        <a href="/p/{{$post->slug}}" class="grow">
            <i class="bx bx-comment text-3xl hover:text-gray-400 cursor-pointer ltr:mr-3 rtl:ml-3"></i>
        </a>
        </div>
        <div class="p-3">
            <a href="/u/{{$post->owner->username}}" class="font-bold ltr:mr-1 rtl:ml-1">{{$post->owner->username}}</a>
            {{$post->description}}
        </div>
        <div class="p-3">
            @if ($post->comments()->count() > 0)
                <a href="/p/{{$post->slug}}" class=" font-bold text-sm text-gray-500">
                    {{__("view all ") . $post->comments()->count() . __(" comments")}}
                </a>
            @endif
        </div>
        <div class="p-3 text-sm text-gray-400 uppercase">
            {{$post->created_at->diffForHumans()}}
        </div>
       
    </div>
    {{-- card footer --}}
    <div class="card-footer ">
        <form action="/p/{{$post->slug}}/comment" method="POST">
            @csrf
            <div class="flex flex-row">
                <textarea name="body"  placeholder="{{__('Add a comment ... ')}}"
                class="h-5 grow resize-none overflow-hidden border-none bg-none p-0 placeholder-gray-400 outline-0 focus:ring-0"></textarea>
                <button type="submit" class="ltr:mr-5 rtl:ml-5 border-none bg-white text-blue-500">{{__("Post")}}</button>
            </div>
        </form>
    </div>
</div>

