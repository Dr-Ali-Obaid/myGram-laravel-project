<div>
    <li class="flex flex-col md:flex-row text-center">
        <div class="font-bold md:font-normal md:mr-1">
            {{$this->count}}
        </div>
        <button wire:click="dispatch('openModal', { component: 'following-modal', arguments: { userId: {{ $userId }} }})"
        class="md:text-black text-neutral-500">
            {{__("following")}}
        </button>
    </li>
</div>
