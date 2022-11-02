<div class="row p-4 pt-5">
    <div class="modal fade" id="modalProd" tabindex="-1" wire:ignore.self role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Gestion Département de la succurale {{optional($selectedSuccursale)->libelle}}</h5>
                </div>
                <div class="modal-body">
                    <div class="d-flex my-4 bg-gray-light p-3">
                        <div class="d-flex flex-grow-1 mr-2">
                            <div class="flex-grow-1 mr-2">
                                <input type="text" wire:model='newDepartement' placeholder="Nom du département" class="form-control  @error('newDepartement') is-invalid @enderror">
                                @error('newDepartement')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div>
                            <button class="btn btn-success" wire:click='addDepartement'>Ajouter</button>
                        </div>
                        
                    </div>
                    <table class="table table-bordered">
                        <thead class="bg-primary">
                            <th>Département</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @forelse($departements as $departement)
                                <tr>
                                <td>{{$departement->libelle}}</td>
                                <td>
                                    <button class="btn btn-link"> <i class="far fa-edit"></i> </button>
                                    <button class="btn btn-link"> <i class="far fa-trash-alt"></i> </button>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="2">
                                        <span class="text-info">Vous n'avez pas encore des départements définies pour cette succursale</span>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" wire:click='closeModal'>Fermer</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-primary">
                <h3 class="card-title flex-grow-1"><i class="fa-regular fa-building fa-2x"></i> Succursales</h3>
                <div class="card-tools d-flex align-items-center">
                    <a class="btn btn-link text-white mr-4 d-block" wire:click="toggleShowAddSuccursaleForm()"><i class="fa-regular fa-building"></i> Nouvelle</a>
                    <div class="input-group input-group-md" style="width: 250px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive p-0 table-striped" style="height: 300px;">
                <table class="table table-head-fixed text-nowrap">
                    <thead>
                        <tr>
                        <th style="width:50%;">Succursales</th>
                        <th style="width:20%;"class="text-center">Ajouté</th>
                        <th style="width:30%;"class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($isAddSuccursale)
                            <tr>
                                <td colspan="2">
                                    <input type="text" wire:keydown.enter='addNewSuccursale' wire:model="newSuccursaleName" class="form-control @error('newSuccursaleName') is-invalid @enderror"/>
                                    @error('newSuccursaleName')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-link" wire:click="addNewSuccursale()"> <i class="fa fa-check"></i> Valider</button>
                                    <button class="btn btn-link" wire:click="toggleShowAddSuccursaleForm()"> <i class="far fa-trash-alt"></i> Annuler</button>
                                </td>
                            </tr>
                        @endif
                        @foreach($succursales as $succursale)
                            <tr>
                                <td>{{ $succursale->libelle }}</td>
                                <td class="text-center">{{ optional($succursale->created_at)->diffForHumans() }}</td>
                                <td class="text-center">
                                    <button class="btn btn-link" wire:click='editSuccursale({{$succursale->id}})'> <i class="far fa-edit"></i> </button>
                                    <button class="btn btn-link" wire:click='showProp({{$succursale->id}})'> <i class="fa-solid fa-bars"></i> </button>
                                    <button class="btn btn-link" wire:click="confirmDelete('{{$succursale->libelle}}',{{$succursale->id}})"> <i class="far fa-trash-alt"></i> </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <div class="float-right">
                    {{ $succursales->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    window.addEventListener("showEditForm",function(e){
        Swal.fire({
        title: "Edition d'une succursale",
        input: 'text',
        inputValue: e.detail.succursale.libelle,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText:'Modifier <i class="fa fa-check"></i>',
        cancelButtonText:'Annuler <i class="fa fa-times"></i>',
        inputValidator: (value) => {
            if (!value) {
                return 'Champ obligatoire'
            }
            @this.updateSuccursale(e.detail.succursale.id,value)
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
            if(event.detail.message.data){
                @this.deleteSuccursale(event.detail.message.data.succursale_id)
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