<div>
    @include("livewire.departements.edit")

    @include("livewire.departements.add")

    @include("livewire.departements.list")
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
        $("#test").modal({"show": true,"backdrop": "static"})
        })
</script>

<script>
    window.addEventListener("closeModal", event=>{
        $("#test").modal("hide")
        })
</script>

<script>
    window.addEventListener("showEditModal", event=>{
        $("#editDepartementModal").modal({"show": true,"backdrop": "static"})
        })

    window.addEventListener("closeEditModal", event=>{
        $("#editDepartementModal").modal("hide")
        })
</script>

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
            @this.deleteDepartement(event.detail.message.data.departement_id)
        }
        })
    })
</script>
