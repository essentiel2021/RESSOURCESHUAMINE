<div>
    @if($currentPage == PAGECREATEFORMTEMPLOYE)
        @include("livewire.employes.create")
    @endif

    @if($currentPage == PAGEEDITFORMTEMPLOYE)
        @include("livewire.employes.edit")
    @endif

    @if($currentPage == PAGELISTEMPLOYE)
        @include("livewire.employes.list")
    @endif
</div>
