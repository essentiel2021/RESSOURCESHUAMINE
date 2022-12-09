<form role="form" wire:submit.prevent="editBlackList()">
    <div class="row p-4 pt-5">
        <div class="col-md-4">
            <div class="card card-primary">
                <div class="card-header d-flex align-items-center">
                    <h3 class="card-title flex-grow-1"><i class="fas fa-fingerprint fa-2x"></i>Black List</h3>
                </div>
                <div class="card-body">
                    <div id="accordion">            
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4 class="card-title flex-grow-1">
                                    <a  data-parent="#accordion" href="#"  aria-expanded="true">Liste Noir</a>
                                </h4>
                                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                    <input wire:model='editEmploye.blackList' @if($editEmploye["blackList"])checked @endif type="checkbox" class="custom-control-input" id="customSwitch{{ $editEmploye["id"]}}">
                                    <label class="custom-control-label" for="customSwitch{{ $editEmploye["id"]}}">{{ $editEmploye["blackList"] == 0 ? "Activé" : "Désactivé" }}</label>
                                </div>
                            </div>
                        </div> 
                        <div class="card-footer">
                            <div class="d-inline">
                                @if($editHasChanged)
                                    <button type="submit" class="btn btn-primary mr-2">Modifier</button>
                                @endif
                            </div>
                             <button type="button" wire:click='goToListEmployeeBlackList()' class="btn btn-danger">Retour à la liste des Employés</button>
                        </div>            
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>