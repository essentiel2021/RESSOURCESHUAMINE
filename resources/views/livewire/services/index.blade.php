<div>
    @include("livewire.services.list")
    @include("livewire.services.addService")
    @include("livewire.services.editService")
</div>

<script>
    window.addEventListener("showEditForm",function(e){
        
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
            if(event.detail.message.data.service_id){
               
            }
        }
        })
    })
</script>
<script>
    window.addEventListener("showModal", event=>{
        $("#modaladdService").modal({"show": true,"backdrop": "static"})
        })
</script>

<script>
    window.addEventListener("closeModal", event=>{
        $("#modaladdService").modal("hide")
        })
</script>

<script>
    window.addEventListener("showEditModal", event=>{
        $("#modaleditService").modal({"show": true,"backdrop": "static"})
        })

    window.addEventListener("closeEditModal", event=>{
        $("#modaleditService").modal("hide")
        })
</script>
