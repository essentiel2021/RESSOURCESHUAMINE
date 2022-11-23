<div>
    @include("livewire.departements.edit")

    @include("livewire.departements.add")

    @include("livewire.departements.list")
</div>
<script>
    window.addEventListener("showAddModal", event=>{
        $("#test").modal({"show": true,"backdrop": "static"})
        })
</script>

<script>
    window.addEventListener("closeModal", event=>{
        $("#test").modal("hide")
        })
</script>
