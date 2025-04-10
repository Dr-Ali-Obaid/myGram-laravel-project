<div class="h-[50rem] lg:flex lg:flex-row overflow-y-auto">
    {{-- Left Side --}}
    <div class="flex h-1/2 lg:h-full items-center justify-center overflow-hidden bg-black lg:w-8/12">
        <img class="h-full w-auto object-cover" src="{{Storage::url($post->image)  }}">
    </div>

    {{-- Right Side --}}
    <div class="lg:w-4/12 flex flex-col bg-white p-5">
        <div class="mt-5 flex flex-row items-center">
            <div>
                <img src="{{Str::startsWith(auth()->user()->image, 'http')? auth()->user()->image : Storage::url(auth()->user()->image)}}" class="w-10 h-10 ltr:mr-2 rtl:ml-2 rounded-full border border-neutral-300">
            </div>
            <div class="flex flex-col grow">
                <div class="font-bold">
                    <a href="/{{ auth()->user()->username }}">{{ auth()->user()->username }}</a>
                </div>
            </div>
        </div>
        <div class="mt-3">
            <textarea placeholder="{{ __('Write description...') }}" wire:model="description"
            class="ring-none border-none h-64 w-full mb-2 rounded">{{$post->description ?? ""}}</textarea>
        @error('description')
        <span class="text-sm text-red-500 py-5">{{ $message }}</span>
        @enderror
            <x-primary-button class="w-full justify-center" wire:click="update">{{ __('Update') }}</x-button>
        </div>
    </div>
</div>
