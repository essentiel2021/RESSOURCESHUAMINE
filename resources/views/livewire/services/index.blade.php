<div class="row p-4 pt-5">
    <div class="col-7">
        <div class="card">
            <div class="card-header bg-primary">
                <h3 class="card-title flex-grow-1"><i class="fa-regular fa-building fa-2x"></i> Services </h3>
                <div class="card-tools d-flex align-items-center">
                    <a href="{{ route("manager.gestsuccursales.departements") }}" class="btn btn-link text-white mr-4 d-block"><i class="fas fa-long-arrow-alt-left"></i> Retour vers la liste des départements</a>
                    <a class="btn btn-link btn-db text-white mr-4 d-block" wire:click='addService'><i class="fa-regular fa-building"></i> Nouveau Servive</a>
                </div>
            </div>
            <div class="card-body table-responsive p-0 table-striped" style="height: 300px;">
                @if($isService)
                    <div class="p-4">
                        <div>
                            @if(!$edit)
                                <div class="form-group">
                                    <input type="text" wire:model='newService.libelle' class="form-control @error('newService.libelle') is-invalid @enderror">
                                </div>
                                @error('newService.libelle')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            @else
                                <div class="form-group">
                                    <input type="text" wire:model='editService.libelle' class="form-control @error('editService.libelle') is-invalid @enderror">
                                </div>
                                @error('editService.libelle')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                @endif
                        </div>
                        <div>
                            <button class="btn btn-link" wire:click='saveService'> <i class="fa fa-check"></i>@if(!$edit)Valider @else Modifier @endif</button>
                            <button class="btn btn-link" wire:click='cancel'> <i class="far fa-trash-alt"></i> Annuler</button>
                        </div>
                    </div>
                @endif
                <table class="table table-head-fixed text-nowrap">
                    <thead>
                        <tr>
                        <th style="width:20%;">Services</th>
                        <th style="width:20%;">Département</th>
                        <th style="width:20%;">Succursale</th>
                        <th style="width:20%;"class="text-center">Ajouté</th>
                        <th style="width:20%;"class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($services as $service)
                            <tr>
                                <td>{{ $service->libelle }}</td>
                                <td>{{ $service->departement->libelle }}</td>
                                <td>{{ $service->departement->succursale->libelle }}</td>
                                <td class="text-center">{{ optional($service->created_at)->diffForHumans() }}</td>
                                <td class="text-center">
                                <button class="btn btn-link" wire:click='editService({{$service->id}})'> <i class="far fa-edit"></i> </button>
                                {{-- <button class="btn btn-link" wire:click='showProp({{$succursale->id}})'> <i class="fa-solid fa-bars"></i> </button> --}}
                                <button class="btn btn-link"> <i class="far fa-trash-alt"></i> </button>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <div class="alert alert-info">
                                        <h5><i class="icon fas fa-ban"></i> Information!</h5>
                                        Aucune donnée en Base.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <div class="float-right">
                    {{ $services->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
