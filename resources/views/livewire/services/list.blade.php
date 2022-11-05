<div class="row p-4 pt-5">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-primary">
                <h3 class="card-title flex-grow-1"><i class="fa-regular fa-building fa-2x"></i> Services </h3>
                <div class="card-tools d-flex align-items-center">
                    <a class="btn btn-link text-white mr-4 d-block"><i class="fa-regular fa-building"></i>Ajouter Servive</a>
                    <div class="input-group input-group-md" style="width: 250px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive p-0 table-striped" style="height: 300px;">
                <table class="table table-head-fixed text-nowrap">
                    <thead>
                        <tr>
                        <th style="width:30%;">Services</th>
                        <th style="width:30%;">Département</th>
                        <th style="width:20%;">Succursale</th>
                        <th style="width:10%;"class="text-center">Ajouté</th>
                        <th style="width:10%;"class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($services as $service)
                            <tr>
                                <td>{{ $service->libelle }}</td>
                                <td>{{ $service->departement->libelle }}</td>
                                <td>{{ $service->departement->succursale->libelle }}</td>
                                <td class="text-center">{{ optional($service->created_at)->diffForHumans() }}</td>
                                <td class="text-center">
                                <button class="btn btn-link"> <i class="far fa-edit"></i> </button>
                                {{-- <button class="btn btn-link" wire:click='showProp({{$succursale->id}})'> <i class="fa-solid fa-bars"></i> </button> --}}
                                <button class="btn btn-link"> <i class="far fa-trash-alt"></i> </button>
                                {{-- @if(count($succursale->departements) == 0)
                                    <button class="btn btn-link" wire:click="confirmDelete('{{$succursale->libelle}}',{{$succursale->id}})"> <i class="far fa-trash-alt"></i> </button>
                                @endif --}} 
                            </tr>
                        @endforeach
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