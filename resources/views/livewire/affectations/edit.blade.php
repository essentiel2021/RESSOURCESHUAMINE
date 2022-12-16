<div class="modal fade" id="affectationEdit" tabindex="-1" wire:ignore.self role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edition d'une affectation</h5>
            </div>
            <div class="modal-body">
                {{-- <div class="d-flex">
                    <div class="form-group flex-grow-1 mr-2">
                        <label for="">Séccursales</label>
                        <select class="form-control" wire:model='selectedSuccursale'>
                            <option value="">------Selectionne une seccursale-----</option>
                            @foreach ($succursales as $item)
                                <option value="{{ $item->id }}">{{ $item->libelle }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group flex-grow-1">
                        <label for="">Département</label>
                        <select wire:model='selectedDepartement' class="form-control">
                            <option value="">-----Selectionne un département----</option>
                            @foreach($departements as $departement)
                                <option value="{{$departement->id}}">{{$departement->libelle}}</option>
                            @endforeach
                        </select>
                    </div>
                </div> --}}
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger">Fermer</button>
            </div>
        </div>
    </div>
</div>