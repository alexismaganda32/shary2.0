
app.controller('FormController', function($scope, $http, $window, $timeout) {

    $scope.data = {};

    $scope.setAction = function() {
        switch (object.action) {
            case 'create' :
                $scope.textAction = 'CREAR';
            break;
            case 'edit' :
                $scope.textAction = 'EDITAR';
            break;
            default:
        }
    }
    
    if (angular.isDefined(object.data)) {
        $scope.data = object.data;
    }

    $scope.save = function(){
        $scope.setMessage();
        $('#save').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');

        switch (object.action){
            case 'create' :
                $http.post(object.url, $scope.data).then(function(response) {
                    $scope.responseSuccess( response );
                })
                .catch(function(response){
                    $scope.responseError( response );
                });
            break;

            case 'edit' :
                $http.put(object.url +'/'+ $scope.data.id, $scope.data).then(function(response) {
                    $scope.responseSuccess( response );
                })
                .catch(function(response){
                    $scope.responseError( response );
                });
            break;

            default:
        }
    };

    $scope.responseSuccess = function( response ) {
        if (response.status === 200 && response.data.msg) {
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

        $scope.msgError = msg;
        $scope.showMsg = 'table';
        $('#save').prop('disabled', false).html('<i class="far fa-check-circle"></i> GUARDAR');
    }

    $scope.setMessage = function(){
        $scope.showMsg = 'none';
        $scope.msgError = '';
    }

    $scope.setAction();
});
