
<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <i class="fas fa-exclamation-triangle fa-5x text-danger"></i>
                        <h3 class="text-danger">¿Estas Seguro?</h3>
                        
                        <p>¡No podrás recuperar el registro: <strong>@{{ dataDestroy.text }}</strong>!</p>
                        <p id="feedbackText" class="uppercase bold"></p>
                        <div class="form-group">
                            <button type="button" class="btn btn-danger btn-sm" ng-click="cancelDelete()">
                                <i class="fa fa-close"></i> CANCELAR
                            </button>
                            <button type="button" class="btn btn-success btn-sm" id="btnDelete" ng-click="destroy()">
                                <i class="fa fa-check-circle-o"></i> SI, ELIMINAR!
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>