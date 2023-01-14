<div>
    @if($currentPage == PAGECREATEFORM)
         @include("livewire.users.create")
    @endif

    @if($currentPage == PAGEEDITFORM)
        @include("livewire.users.edit")
    @endif

    @if($currentPage == PAGELIST)
        @include("livewire.users.list")
    @endif
</div>


<script>
    window.addEventListener("showConfirmMessage", event=>{
        Swal.fire({
        title:event.detail.message.title,
        text: event.detail.message.text,
        icon:event.detail.message.type,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Continuer',
        cancelButtonText: 'Annuler',
        }).then((result) => {
        if (result.isConfirmed) {
            @this.resetPassword()
        }
        })
    })
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
<script>
    window.addEventListener("affichageDesactiveConfirmMessage", event=>{
        Swal.fire({
        title:event.detail.message.title,
        text: event.detail.message.text,
        icon:event.detail.message.type,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Continuer',
        cancelButtonText: 'Annuler',
        }).then((result) => {
        if (result.isConfirmed) {
            @this.desactiveUser(event.detail.message.data.user_id)
        }
        })
    })
</script>
