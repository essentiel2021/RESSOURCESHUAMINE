<div class="row p-4 pt-5">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-primary">
                <h3 class="card-title flex-grow-1"><i class="fas fa-users fa-2x"></i>Liste des employés</h3>
                <div class="card-tools d-flex align-items-center">
                    {{-- <a class="btn btn-link text-white mr-4 d-block"><i class="fas fa-user-plus"></i>Nouveau employé</a> --}}
                    <div class="input-group input-group-md" style="width: 250px;">
                        <input type="text" name="table_search" wire:model.debounce.250ms="search" class="form-control float-right" placeholder="Recherche">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive p-0 table-striped" >
                {{-- <div class="d-flex justify-content-end p-4 bg-indigo">
                    <div class="form-group mr-3">
                        <label for="filtreType">Filtrer par commune</label>
                        <select  id="filtreCommune" wire:model="filtreCommune" class="form-control">
                                <option value=""></option>
                                @foreach ($communeemployes as $communeemploye)
                                    <option value="{{ $communeemploye->id}}">{{ $communeemploye->libelle }}</option>
                                @endforeach
                        </select>
                    </div>

                    <div class="form-group mr-3">
                        <label for="filtreSituaion">Filtrer par Situation matrimoniale</label>
                        <select  id="filtreSituaion" wire:model="filtreSituaion" class="form-control">
                                <option value=""></option>
                                @foreach ($situationemployes as $situationemploye)
                                    <option value="{{$situationemploye->id}}">{{ $situationemploye->libelle }}</option>
                                @endforeach
                        </select>
                    </div>

                    <div class="form-group mr-3">
                        <label for="filtreblack">Filtrer par BlackList</label>
                        <select  id="filtreblack" wire:model="filtreblack" class="form-control">
                            <option value=""></option>
                            <option value="1">Black list</option>
                            <option value="0">Pas Black list</option>
                        </select>
                    </div>

                </div> --}}
                <table class="table table-head-fixed text-nowrap">
                    <thead>
                        <tr>
                            <th style="width:5%;"></th>
                            <th style="width:25%;" class="text-center">Matricule</th>
                            <th style="width:20%;" class="text-center">Nom</th>
                            <th style="width:20%;" class="text-center">Prenom</th>
                            <th style="width:30%;"class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($employes as $employe)
                            <tr>
                                <td><img src="{{asset($employe->photo)}}" style="width:100px;height:100px;"></td>
                                <td class="text-center">{{$employe->matricule}}</td>
                                <td class="text-center">{{$employe->nom}}</td>
                                <td class="text-center">{{$employe->prenom}}</td>
                                <td class="text-center">
                                    @if ($employe->services->count() == 0 ||$employe->services->where('is_end', true)->count() > 0)
                                        <button class="btn btn-link" title="Effectuer une mutation" wire:click='showAffectation({{$employe->id}})'><i class="fa-sharp fa-solid fa-money-check"></i></button>
                                    @endif
                                    <button class="btn btn-link" wire:click='editAffectation({{$employe->id}})' title="Mettre fin à la mutation"><i class="far fa-edit"></i></button>
                                    
                                    <button class="btn btn-link" title="Historique des mutation"><i class="nav-icon fa-solid fa-bars"></i></button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">
                                    <div class="alert alert-danger">
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
                    {{ $employes->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
