<div>
    @if ($user->posts->count() > 0 and ($user->private_account ==false or $user->id == auth()->id() or auth()->user()->isFollowing($user)))
    <div class="grid grid-cols-3 gap-1 my-5">
        @foreach ($user->posts as $post)
            <a href="/p/{{$post->slug}}" class="block aspect-square w-full">
            <img src="{{Storage::url($post->image)}}" alt="{{$post->description}}" class="w-full aspect-square object-cover">
        </a>
        @endforeach
    </div>
@else 
    <div class="w-full text-center mt-20">
        @if ($user->private_account ==true and $user->id != auth()->user()->id )
            {{__("This account is private. Follow to see their photos.")}}
        @else
            {{__("This user has no posts.")}}
        @endif
    </div>

@endif
</div>
