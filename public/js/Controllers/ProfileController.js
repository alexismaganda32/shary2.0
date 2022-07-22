
app.controller('ProfileController', function($scope, $http, $window, $timeout) {

    $scope.data = {};

    $scope.changePersonalInformation = function(){
        $scope.setMessage();
        $('#btnChangePersonalInformation').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');

        $http.post(object.url+'/changePersonalInformation', $scope.data).then(function(response) {
            $scope.responseSuccess( response );
        })
        .catch(function(response){
            $scope.responseError( response );
        });
    };

    $scope.changePassword = function(){
        $scope.setMessage();
        $('#btnChangePassword').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');

        $http.post(object.url+'/changePassword', $scope.data).then(function(response) {
            $scope.responseSuccess( response );
        })
        .catch(function(response){
            $scope.responseError( response );
        });
    };

    $scope.responseSuccess = function( response ) {
        if (response.status === 200 && response.data.msg) {
            $('#modalSuccess .modal-body #feedbackText').html(response.data.msg);
            $('#modalSuccess').modal('show');
            $timeout( function(){
                window.location.href = object.url+'/profile';
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
        $('#btnChangePersonalInformation').prop('disabled', false).html('<i class="far fa-check-circle"></i> GUARDAR');
        $('#btnChangePassword').prop('disabled', false).html('<i class="far fa-check-circle"></i> GUARDAR');
    }

    $scope.setMessage = function(){
        $scope.showMsg = 'none';
        $scope.msgError = '';
    }
});
