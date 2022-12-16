<div>
    @include("livewire.affectations.edit")
    
    @include("livewire.affectations.add")

    @include("livewire.affectations.list")
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

    window.addEventListener("showEditModal", event=>{
        $("#affectationEdit").modal({"show": true,"backdrop": "static"})
        })
</script>

<script>
    window.addEventListener("closeModal", event=>{
        $("#affectationAdd").modal("hide")
        })
</script>