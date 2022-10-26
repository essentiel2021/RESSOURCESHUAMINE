<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
</div>
<div class="row p-4 pt-5">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-primary">
                <h3 class="card-title flex-grow-1"><i class="fa-regular fa-building fa-2x"></i> Succursales</h3>
                <div class="card-tools d-flex align-items-center">
                    <a class="btn btn-link text-white mr-4 d-block"><i class="fa-regular fa-building"></i> Nouvelle</a>
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
                        @foreach($succursales as $succursale)
                            <tr>
                                <td>{{ $succursale->libelle }}</td>
                                <td class="text-center">{{ optional($succursale->created_at)->diffForHumans() }}</td>
                                <td class="text-center">
                                    <button class="btn btn-link"> <i class="far fa-edit"></i> </button>
                                    <button class="btn btn-link"> <i class="far fa-trash-alt"></i> </button>
                                </td>
                            </tr>
                        @endforeach
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