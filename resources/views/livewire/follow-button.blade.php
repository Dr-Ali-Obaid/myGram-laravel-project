<div>
  @if ($follow_state == "Pending")
      <span class="w-30 bg-gray-400 text-white text-sm cursor-pointer font-bold py-1 px-3 text-center rounded">
        {{__("Pending")}}
      </span>
  @else
  <button  wire:click="toggling" class=" {{ $classes }} w-30 cursor-pointer text-sm font-bold py-1 px-3 rounded text-center">
    {{__($follow_state)}}
  </button>
  @endif
  
</div>
