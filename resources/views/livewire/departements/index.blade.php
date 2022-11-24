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
