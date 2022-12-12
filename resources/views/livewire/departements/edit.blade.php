<div class="modal fade" id="editDepartementModal" tabindex="-1" wire:ignore.self role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edition de Département</h5>
            </div>
            <div class="modal-body">
                <div class="d-flex my-4 bg-gray-light p-3">
                    <div class="d-flex flex-grow-1 mr-2">
                        <div class="flex-grow-1 mr-2">
                            <select class="form-control" wire:model='editDepartement.succursale_id'>
                                <option value="{{ $editDepartement["succursale_id"]}}">{{ $editDepartement["succursale"]["libelle"]}}</option>
                            </select>
                        </div>
                         <div class="flex-grow-1 ">
                            <input type="text" wire:model='editDepartement.libelle' placeholder="Nom du département" class="form-control @error('editDepartement.libelle') is-invalid @enderror">
                            @error('editDepartement.libelle')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div>
                        @if($editHasChanged)
                            <button class="btn btn-success" wire:click='updateDepartement()'>Modifier</button>
                        @endif
                    </div>   
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" wire:click='fermerModalEdit()'>Fermer</button>
            </div>
        </div>
    </div>
</div>