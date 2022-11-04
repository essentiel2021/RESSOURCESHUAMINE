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
                            <input type="text" wire:model='newDepartement' wire:keydown.enter='addDepartement' placeholder="Nom du département" class="form-control  @error('newDepartement') is-invalid @enderror">
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
                                    <button class="btn btn-link" wire:click="editDepartement({{$departement->id}})"> <i class="far fa-edit"></i> </button>
                                    <button class="btn btn-link" wire:click="showDeleteDep('{{$departement->libelle}}', {{$departement->id}})"> <i class="far fa-trash-alt"></i> </button>
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