<div class="modal fade" id="modaladdService" tabindex="-1" wire:ignore.self role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajout de Service</h5>
            </div>
            <div class="modal-body">
                <div class="d-flex my-4 bg-gray-light p-3">
                    <div class="d-flex flex-grow-1 mr-2">
                        <div class="flex-grow-1 mr-2">
                            <input type="text" wire:model='newService.libelle' placeholder="Nom du service" class="form-control  @error("newService.libelle") is-invalid @enderror">
                            @error("newService.libelle")
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="flex-grow-1">
                            <select class="form-control @error("newService.departement") is-invalid @enderror" wire:model='newService.departement'>
                                <option value=""></option>
                                @foreach($departements as $departement)
                                    <option value="{{$departement->id}}">{{$departement->libelle}}</option>
                                @endforeach
                            </select>
                            @error("newService.departement")
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