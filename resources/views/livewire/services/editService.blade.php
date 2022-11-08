<div class="modal fade" id="modaleditService" tabindex="-1" wire:ignore.self role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edition de Service</h5>
            </div>
            <div class="modal-body">
                <div class="d-flex my-4 bg-gray-light p-3">
                    <div class="d-flex flex-grow-1 mr-2">
                        <div class="flex-grow-1 mr-2">
                            <input type="text" wire:model='editService.libelle' placeholder="Nom du service" class="form-control  @error("newService.libelle") is-invalid @enderror">
                            @error("editService.libelle")
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="flex-grow-1">
                            <select class="form-control @error("editService.departement") is-invalid @enderror" wire:model='editService.departement'>
                                <option value=""></option>
                            </select>
                            @error("editService.departement")
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-success" wire:click='addServices'>Ajouter</button>
                    </div>   
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" wire:click='closeModal'>Fermer</button>
            </div>
        </div>
    </div>
</div>