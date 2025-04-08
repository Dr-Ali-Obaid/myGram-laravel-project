<div>
    <li class="flex flex-col md:flex-row text-center md:rtl:mr-8">
        <div class="font-bold md:font-normal md:ltr:mr-1 md:rtl:ml-1">
            {{$this->countFollowers()}}
        </div>
        <button wire:click="$dispatch('openModal', { component: 'follower-modal', arguments: { userId: {{ $userId }} } })" class="md:text-black text-neutral-500">
            {{ $this->countFollowers() > 1 ? __("followers") : __("follower") }}
        </button>
    </li>
</div>
