<div class="row p-4 pt-5">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-user-plus fa-2x"></i></h3>
            </div>
            <div class="card-body">
                <div class="d-flex">
                    <div class="form-group flex-grow-1 mr-2">
                        <label for="name">Nom</label>
                        <input type="text" class="form-control" id="name"  placeholder="Nom de l'employé">
                    </div>
                    <div class="form-group flex-grow-1">
                        <label for="lastName">Prénom</label>
                        <input type="text" class="form-control" id="lastName" placeholder="Prénom de l'employé">
                    </div>
                </div>
                <div class="d-flex">
                    <div class="form-group flex-grow-1 mr-2">
                        <label for="">Sexe</label>
                        <select class="form-control">
                            <option value="">--------------</option>
                            <option value="M">Homme</option>
                            <option value="F">Femme</option>
                        </select>
                    </div>
                    <div class="form-group flex-grow-1">
                        <label for="">Situation Matrimoniale</label>
                        <select class="form-control">
                            <option value="">--------------</option>
                            @foreach ($situationemployes as $item)
                                <option value="{{$item->libelle}}">{{$item->libelle}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Pièce d'identité</label>
                    <select class="form-control">
                        <option value="">--------------</option>
                        @foreach ($pieceIdentites as $item)
                            <option value="{{$item->id}}">{{$item->libelle}}</option> 
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    {{-- <label for="exampleInputEmail1">Numero de Pièce d'identité</label> --}}
                    <input type="text" class="form-control" id="" placeholder="Saisissez le numero de la pièce selectionné">
                </div>
                <div class="form-group">
                    <label>Date:</label>
                      <div class="input-group date" id="reservationdate" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                          <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                      </div>
                  </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nombre d'enfant</label>
                    <input type="numeric" class="form-control" id="exampleInputEmail1">
                </div>
                {{-- <div class="form-group">
                    <label for="exampleInputEmail1">Adresse Mail</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                </div> --}}
            </div> 
        </div>
    </div>
    <div class="col-md-6">
        <div class="card card-success">
            <div class="card-header">
              <h3 class="card-title">Different Height</h3>
            </div>
            <div class="card-body">
              <input class="form-control form-control-lg" type="text" placeholder=".form-control-lg">
              <br>
              <input class="form-control" type="text" placeholder="Default input">
              <br>
              <input class="form-control form-control-sm" type="text" placeholder=".form-control-sm">
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>

