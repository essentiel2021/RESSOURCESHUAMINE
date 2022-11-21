<div class="row p-4 pt-5">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-primary">
                <h3 class="card-title flex-grow-1"><i class="fas fa-users fa-2x"></i>Liste des employés</h3>
                <div class="card-tools d-flex align-items-center">
                    <a class="btn btn-link text-white mr-4 d-block"><i class="fas fa-user-plus"></i>Nouveau employé</a>
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
                <table class="table table-head-fixed text-nowrap">
                    <thead>
                        <tr>
                            <th style="width:5%;"></th>
                            <th style="width:20%;">Matricule</th>
                            <th style="width:20%;">Nom</th>
                            <th style="width:20%;">Prenom</th>
                            <th style="width:20%;"class="text-center">Situation matrimoniale</th>
                            <th style="width:10%;"class="text-center">Commune</th>
                            <th style="width:5%;"class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($employes as $employe)
                            <tr>
                                <td><img src="{{asset('images/imageplaceholder.png')}}" style="width:60px;height:60px;"></td>
                                <td>{{$employe->matricule}}</td>
                                <td>{{$employe->nom}}</td>
                                <td>{{$employe->prenom}}</td>
                                <td class="text-center">{{$employe->situation->libelle }}</td>
                                <td class="text-center">{{$employe->commune->libelle }}</td>
                                <td class="text-center">
                                    <button class="btn btn-link"> <i class="far fa-edit"></i></button>
                                    <button class="btn btn-link"><i class="far fa-trash-alt"></i></button>
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
