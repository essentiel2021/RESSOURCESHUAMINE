<div class="row p-4 pt-5">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-primary">
                <h3 class="card-title flex-grow-1"> <i class="fa-solid fa-user-gear fa-2x"></i> Gestion Fonction </h3>
                <div class="card-tools d-flex align-items-center">
                    <a class="btn btn-link btn-db text-white mr-4 d-block" wire:click='showFonction()'><i class="fa-solid fa-user-gear"></i> Nouvelle Fonction</a>
                </div>
            </div>
            <div class="card-body table-responsive p-0 table-striped">
                <table class="table table-head-fixed text-nowrap">
                    <thead>
                        <tr>
                        <th style="width:50%;">Services</th>
                        <th style="width:50%;"class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($fonctions as $fonction)
                            <tr>
                                <td>{{ $fonction->libelle }}</td>
                                {{-- <td class="text-center">{{ optional($service->created_at)->diffForHumans() }}</td> --}}
                                <td class="text-center">
                                <button class="btn btn-link" wire:click='editFonction({{ $fonction->id }})'> <i class="far fa-edit"></i> </button>
                                @if(count($fonction->employes) == 0)
                                    <button class="btn btn-link" wire:click="confirmDelete('{{$fonction->libelle}}',{{$fonction->id}})"> <i class="far fa-trash-alt"></i> </button>
                                    {{-- <button class="btn btn-link" wire:click="confirmDelete('{{$succursale->libelle}}',{{$succursale->id}})"> <i class="far fa-trash-alt"></i> </button> --}}
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2">
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
                    {{ $fonctions->links() }}
                </div>
            </div>
        </div>
    </div>
</div>