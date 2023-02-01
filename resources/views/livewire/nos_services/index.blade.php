<div>
    @if($editService != [])
        @include("livewire.nos_services.edit")
    @endif

    @include("livewire.nos_services.add")

    @include("livewire.nos_services.list")
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

<script>
    window.addEventListener("showAddModal", event=>{
       $("#addServiceModal").modal({"show": true,"backdrop": "static"})
       })
       
   window.addEventListener("closeModal", event=>{
       $("#addServiceModal").modal("hide")
       })
</script>

<script>
   window.addEventListener("showEditModal", event=>{
       $("#editServicetModal").modal({"show": true,"backdrop": "static"})
       })

   window.addEventListener("closeEditModal", event=>{
       $("#editServicetModal").modal("hide")
       })


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
            if(event.detail.message.data){
                @this.deleteService(event.detail.message.data.service_id)
            }
        }
        })
    })
</script>

{{-- <script>
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
</script> --}}
