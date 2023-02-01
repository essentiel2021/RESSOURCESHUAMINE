<div class="modal fade" id="editFonctionModal" tabindex="-1" wire:ignore.self role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edition Fonction</h5>
            </div>
            <div class="modal-body">
                <div class="d-flex my-4 bg-gray-light p-3">
                    <div class="d-flex flex-grow-1 mr-2">
                        <div class="flex-grow-1 ">
                            <input type="text" wire:model='editLibelle.libelle' placeholder="Nom de la fonction" class="form-control @error('editLibelle.libelle') is-invalid @enderror">
                            @error('editLibelle.libelle')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div>
                        @if ($editHasChanged)
                            <button class="btn btn-success" wire:click='updateFonction()'>Modifier</button>
                        @endif
                    </div>   
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" wire:click='closeModalEdit()'>Fermer</button>
            </div>
        </div>
    </div>
</div>
