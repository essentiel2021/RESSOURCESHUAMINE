<div>
    @if ($editLibelle != [])
    @include("livewire.fonctions.edit")
    @endif
    @include("livewire.fonctions.add")

    @include("livewire.fonctions.list")
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
       $("#addFonctionModal").modal({"show": true,"backdrop": "static"})
       })
       
   window.addEventListener("closeModal", event=>{
       $("#addFonctionModal").modal("hide")
       })
</script>
<script>
     window.addEventListener("showEditModal", event=>{
       $("#editFonctionModal").modal({"show": true,"backdrop": "static"})
    })
    window.addEventListener("closeEditModal", event=>{
       $("#editFonctionModal").modal("hide")
       })



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
            if (event.detail.message.data) {
                @this.deleteFonction(event.detail.message.data.fonction_id)
            }
        }
        })
    })
</script>