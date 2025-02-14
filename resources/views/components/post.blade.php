<div class="card">
    <div class="card-header">
        <img src="{{$post->owner->image}}" alt="" class="w-9 h-9 mr-2 rounded-full">
        <a href="/{{$post->owner->username}}" class="font-bold">{{$post->owner->username}}</a>
    </div>
    <div class="card-body">
        <div class="max-h-[35rem] overflow-hidden">
            <img src="{{ asset('storage/' . $post->image) }}" alt="{{$post->description}}" class="h-auto w-full object-cover">
        </div>
        <div class="p-3">
            <a href="/{{$post->owner->username}}" class="font-bold mr-1">{{$post->owner->username}}</a>
            {{$post->description}}
        </div>
        <div class="p-3">
            @if ($post->comments()->count() > 0)
                <a href="/p/{{$post->slug}}" class=" font-bold text-sm text-gray-500">
                    {{__("view all " . $post->comments()->count() . " comments")}}
                </a>
            @endif
        </div>
        <div class="p-3 text-sm text-gray-400 uppercase">
            {{$post->created_at->diffForHumans()}}
        </div>
       
    </div>
    <div class="card-footer ">
        <form action="/p/{{$post->slug}}/comment" method="POST">
            @csrf
            <div class="flex flex-row">
                <textarea name="body"  placeholder="{{__('Add a comment ... ')}}"
                class="h-5 grow resize-none overflow-hidden border-none bg-none p-0 placeholder-gray-400 outline-0 focus:ring-0"></textarea>
                <button type="submit" class="ml-5 border-none bg-white text-blue-500">{{__("Post")}}</button>
            </div>
        </form>
    </div>
</div>
