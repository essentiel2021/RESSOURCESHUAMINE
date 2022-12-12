<div class="modal fade" id="test" tabindex="-1" wire:ignore.self role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Gestion Département</h5>
            </div>
            <div class="modal-body">
                <div class="d-flex my-4 bg-gray-light p-3">
                    <div class="d-flex flex-grow-1 mr-2">
                        <div class="flex-grow-1 mr-2">
                            <select class="form-control @error('succursale_id') is-invalid @enderror" wire:model='succursale_id'>
                                <option value="">--Choissir une Succursale--</option>
                                @foreach($succursales as $succursale)
                                    <option value="{{$succursale->id}}">{{ $succursale->libelle}}</option>
                                @endforeach
                            </select>
                            @error('succursale_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- @if(!is_null($selectedSuccursale))
                            <div class="flex-grow-1 mr-2">
                                <select class="form-control">
                                    <option value="">--Département--</option>
                                    @foreach ( $departementAll as $item)
                                        <option value="{{$item->id}}">{{$item->libelle}}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif --}}
                        @if(!is_null($succursale_id))
                            <div class="flex-grow-1 ">
                                <input type="text" wire:model='libelle' placeholder="Nom du département" class="form-control @error('libelle') is-invalid @enderror">
                                @error('libelle')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif
                    </div>
                    <div>
                        <button class="btn btn-success" wire:click='addDepartement()'>Ajouter</button>
                    </div>   
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" wire:click='fermerModal()'>Fermer</button>
            </div>
        </div>
    </div>
</div>