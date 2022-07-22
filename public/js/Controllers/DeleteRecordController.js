
app.controller('DeleteRecordController', function($scope, $http, $window, $timeout, $location) {

    $scope.dataDestroy = {};

    $scope.delete = function(identificador, text) {
        $scope.dataDestroy.id = identificador;
        $scope.dataDestroy.text = text.toUpperCase();
        $('#modalDelete').modal('show');
    }

    $scope.destroy = function() {
        $('#btnDelete').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> espere...');
        $http.delete(object.url +'/'+ $scope.dataDestroy.id).then(function(response) {
            $scope.responseSuccess( response );
        })
        .catch(function(response){
            $scope.responseError( response );
        });
    }

    $scope.cancelDelete = function() {
        $scope.dataDestroy = {};
        $('#modalDelete').modal('hide');
    }

    $scope.responseSuccess = function( response ) {
        if (response.status === 200 && response.data.msg) {
            $('#modalDelete').modal('hide');
            $('#modalSuccess .modal-body #feedbackText').html(response.data.msg);
            $('#modalSuccess').modal('show');
            $timeout( function(){
                window.location.href = object.url;
            }, 1500 );
        }else {
            $scope.responseError( {} );
        }
    }

    $scope.responseError = function(response, section){
        let msg = 'Error en el servidor o base de datos';
        if (response.status === 422) {
            if (angular.isUndefined(response.data.errors.length)) {
                for (var i in response.data.errors ) {
                    msg = response.data.errors[i][0]; //validation form request
                    break;
                }
            }
        }
        
        $('#modalDelete').modal('hide');
        $('#btnDelete').prop('disabled', false).html('<i class="far fa-check-circle"></i> SI, ELIMINAR!');
        toastr.error(msg, 'Alerta!');
    }
});
