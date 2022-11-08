<div class="row p-4 pt-5">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-primary">
                <h3 class="card-title flex-grow-1"><i class="fa-regular fa-building fa-2x"></i> Succursales</h3>
                <div class="card-tools d-flex align-items-center">
                    <a class="btn btn-link text-white mr-4 d-block" wire:click="toggleShowAddSuccursaleForm()"><i class="fa-regular fa-building"></i> Nouvelle</a>
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
                        <th style="width:50%;">Succursales</th>
                        <th style="width:20%;"class="text-center">Ajouté</th>
                        <th style="width:30%;"class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($isAddSuccursale)
                            <tr>
                                <td colspan="2">
                                    <input type="text" wire:keydown.enter='addNewSuccursale' wire:model="newSuccursaleName" class="form-control @error('newSuccursaleName') is-invalid @enderror"/>
                                    @error('newSuccursaleName')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-link" wire:click="addNewSuccursale()"> <i class="fa fa-check"></i> Valider</button>
                                    <button class="btn btn-link" wire:click="toggleShowAddSuccursaleForm()"> <i class="far fa-trash-alt"></i> Annuler</button>
                                </td>
                            </tr>
                        @endif
                        @forelse($succursales as $succursale)
                            <tr>
                                <td>{{ $succursale->libelle }}</td>
                                <td class="text-center">{{ optional($succursale->created_at)->diffForHumans() }}</td>
                                <td class="text-center">
                                <button class="btn btn-link" wire:click='editSuccursale({{$succursale->id}})'> <i class="far fa-edit"></i> </button>
                                <button class="btn btn-link" wire:click='showProp({{$succursale->id}})'> <i class="fa-solid fa-bars"></i> </button>
                                @if(count($succursale->departements) == 0)
                                    <button class="btn btn-link" wire:click="confirmDelete('{{$succursale->libelle}}',{{$succursale->id}})"> <i class="far fa-trash-alt"></i> </button>
                                @endif
                                {{-- <button class="btn btn-link" wire:click="confirmDelete('{{$succursale->libelle}}',{{$succursale->id}})"> <i class="far fa-trash-alt"></i> </button> --}}
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
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
                    {{ $succursales->links() }}
                </div>
            </div>
        </div>
    </div>
</div>