<div class="modal fade" id="affectationAdd" tabindex="-1" wire:ignore.self role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Affectations</h5>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Séccursales</label>
                    <select class="form-control" wire:model='selectedSuccursale'>
                        <option value="">------Selectionne une seccursale-----</option>
                        @foreach ($succursales as $item)
                            <option value="{{ $item->id }}">{{ $item->libelle }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    @if(!is_null($selectedSuccursale))
                        <label for="">Département</label>
                        <select wire:model='selectedDepartement' class="form-control">
                            <option value="">-----Selectionne un département----</option>
                            @foreach($departements as $departement)
                                <option value="{{$departement->id}}">{{$departement->libelle}}</option>
                            @endforeach
                        </select>
                    @endif
                </div>
               @if(!is_null($selectedDepartement))
                    <div class="form-group flex-grow-1 mr-2">
                        <label for="">Services</label>
                        <select class="form-control" wire:model='newServiceId'>
                            <option value="">------Selectionne un service-----</option>
                            @foreach ($services as $service)
                                    <option value="{{$service->id}}">{{$service->libelle}}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
                @if (!is_null($newServiceId))
                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label>Date prise de service</label>
                            <input type="date" class="form-control @error('newAffectation.date_debut') is-invalid @enderror" wire:model='newAffectation.date_debut'>
                            @error("newAffectation.date_debut")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group flex-grow-1">
                            <label>Durée (en mois)</label>
                            <input type="number" class="form-control @error('newAffectation.nombre_mois') is-invalid @enderror" wire:model='newAffectation.nombre_mois'>
                            @error("newAffectation.nombre_mois")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" wire:click='addAffectation()' class="btn bg-gradient-success">Affecter</button>
                <button type="button" wire:click='closeAddAffectationModal()' class="btn btn-danger">Fermer</button>
            </div>
        </div>
    </div>
</div>