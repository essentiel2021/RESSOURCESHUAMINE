<div wire:ignore.self>
    @if($currentPage == PAGECREATEFORMTEMPLOYE)
        @include("livewire.employes.add")
    @endif

    @if($currentPage == PAGEEDITFORMTEMPLOYE)
        @include("livewire.employes.edit")
    @endif

    @if($currentPage == PAGELISTEMPLOYE)
        @include("livewire.employes.list")
    @endif
    @include('livewire.employes.newAffectation')
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
    window.addEventListener("showAddModal", event=>{
        $("#affectationAdd").modal({"show": true,"backdrop": "static"})
        })
    
        window.addEventListener("closeModal", event=>{
        $("#affectationAdd").modal("hide")
        })
</script>
<script>
     window.addEventListener("showConfirmMessage", event=>{
       Swal.fire({
        title: event.detail.message.title,
        text: event.detail.message.text,
        icon: event.detail.message.type,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Continuer',
        cancelButtonText: 'Annuler'
        }).then((result) => {
        if (result.isConfirmed) {
            @this.supprimerEmploye(event.detail.message.data.employe_id)
        }
        })
    })
</script>
