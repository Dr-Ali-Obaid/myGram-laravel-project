<div class="w-[30rem] mx-auto lg:w-[95rem]">
        @forelse ($this->posts as $post)
        @livewire('post', ['post' => $post], key($post->id))
        @empty
        <div class="max-w-2xl gap-8 mx-auto">
            {{__('Start following your friends and enjoy.')}}
        </div>
            
        @endforelse
        
</div>

