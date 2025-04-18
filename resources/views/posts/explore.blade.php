<x-app-layout>
    <div class="grid grid-cols-3 gap-1 md:gap-5 mt-8">
        @foreach ($posts as $post)
            <div>
                <a href="/p/{{ $post->slug }}">
                    <img src="{{ Storage::url($post->image) }}" class="w-full aspect-square object-cover">
                </a>
            </div>
        @endforeach
    </div>
    <div class="mt-5">
        {{ $posts->links() }}
    </div>
</x-app-layout>
