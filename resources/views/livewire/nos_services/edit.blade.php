<div class="modal fade" id="editServicetModal" tabindex="-1" wire:ignore.self role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edition de Service</h5>
            </div>
            <div class="modal-body">
                <div class="d-flex my-4 bg-gray-light p-3">
                    <div class="d-flex flex-grow-1">
                        <div class="flex-grow-1 mr-2">
                            <select class="form-control" wire:model='editService.departement_id'>
                                <option value="{{ $editService["departement_id"]}}">{{ $editService["departement"]["libelle"]}}</option>
                            </select>
                        </div>
                        <div class="flex-grow-1 ">
                            <input type="text" wire:model='editService.libelle' placeholder="Nom du département" class="form-control @error('editService.libelle') is-invalid @enderror">
                            @error('editService.libelle')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div>
                        @if($editHasChanged)
                            <button class="btn btn-success" wire:click='updateService()'>Modifier</button>
                        @endif
                    </div>   
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" wire:click='fermerEditModal()'>Fermer</button>
            </div>
        </div>
    </div>
</div>