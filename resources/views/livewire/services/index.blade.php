<div>
    @include("livewire.services.editServ")

    @include("livewire.services.addServ")

    @include("livewire.services.list")
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
            if(event.detail.message.data.succursale_id){
               
            }
            if(event.detail.message.data.departement_id){
                
            }
        }
        })
    })
</script>
<script>
    window.addEventListener("showModal", event=>{
        $("#modalProd").modal({"show": true,"backdrop": "static"})
        })
</script>

<script>
    window.addEventListener("closeModal", event=>{
        $("#modalProd").modal("hide")
        })
</script>

<script>
    window.addEventListener("showEditModal", event=>{
        $("#editModalProd").modal({"show": true,"backdrop": "static"})
        })

    window.addEventListener("closeEditModal", event=>{
        $("#editModalProd").modal("hide")
        })
</script>
