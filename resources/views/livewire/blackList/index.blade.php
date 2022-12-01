<div wire:ignore.self>
    @if($currentPage == PAGEEDITFORMBLACKLIST)
        @include("livewire.blackList.edit")
    @endif

    @if($currentPage == PAGELISTBLACKLIST)
        @include("livewire.blackList.list")
    @endif
</div>
