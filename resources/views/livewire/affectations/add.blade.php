<div class="modal fade" id="affectationAdd" tabindex="-1" wire:ignore.self role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Affectations</h5>
            </div>
            <div class="modal-body">
                <div class="d-flex">
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
                </div>
               @if(!is_null($selectedDepartement))
                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label for="">Services</label>
                            <select class="form-control" wire:model='newAffectation.service_id'>
                                <option value="">------Selectionne un service-----</option>
                                @foreach ($services as $service)
                                        <option value="{{$service->id}}">{{$service->libelle}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group flex-grow-1">
                            <label>Date prise de service</label>
                            <input type="date" class="form-control @error('newAffectation.date_debut') is-invalid @enderror" wire:model='newAffectation.date_debut'>
                            @error("newAffectation.date_debut")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label>Mettre fin au service</label>
                            <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                <input wire:model='newAffectation.is_end' type="checkbox" class="custom-control-input" id="customSwitch">
                                <label class="custom-control-label" for="customSwitch">Activé</label>
                            </div>
                        </div>
                        <div class="form-group flex-grow-1">
                            <label>Date fin prise de service</label>
                            <input type="date" class="form-control @error('newAffectation.date_fin') is-invalid @enderror" wire:model='newAffectation.date_fin'>
                            @error("newAffectation.date_fin")
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