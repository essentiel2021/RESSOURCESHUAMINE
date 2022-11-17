<div>
    @if($currentPage == PAGECREATEFORMTEMPLOYE)
        @include("livewire.employes.create")
    @endif

    @if($currentPage == PAGEEDITFORM)
        @include("livewire.employes.edit")
    @endif

    @if($currentPage == PAGEEDITFORMTEMPLOYE)
        @include("livewire.employes.list")
    @endif
</div>
