<div wire:ignore.self>
    @if($currentPage == PAGEEDITFORMBLACKLIST)
        @include("livewire.blackList.edit")
    @endif

    @if($currentPage == PAGELISTBLACKLIST)
        @include("livewire.blackList.list")
    @endif
</div>
<script>
    window.addEventListener("showSuccessMessage", event=>{
        Swal.fire({
                position: 'top-end',
                icon: 'success',
                toast:true,
                title: event.detail.message || "Opération effectuée avec succès!",
                showConfirmButton: false,
                timer: 5000
                }
            )
    })
</script>
