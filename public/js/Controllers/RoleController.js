
app.controller('RoleController', function($scope, $http, $window, $timeout) {

    $scope.data = {
        permissions : []
    };
    $scope.allPer = 0;

    $scope.setAction = function() {
        switch (object.action) {
            case 'create' :
                $scope.textAction = 'CREAR';
                for(let i in object.modules) {
                    $scope.data.permissions.push({
                        module_id : object.modules[i].id,
                        alias : object.modules[i].alias,
                        read : 0,
                        create : 0,
                        edit : 0,
                        destroy : 0,
                    });
                }
            break;
            case 'edit' :
                $scope.textAction = 'EDITAR';
                if (angular.isDefined(object.data)) {
                    $scope.data = object.data;
                }
            break;
            default:
        }
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

    $scope.allCol = function(columna, value){
        angular.forEach($scope.data.permissions, function(permiso, keyP) {
            switch(columna) {
                case 'read':
                    permiso.read = value;
                break;
                case 'create':
                    permiso.create = value;
                break;
                case 'edit':
                    permiso.edit = value;
                break;
                case 'destroy':
                    permiso.destroy = value;
                break;
                default:
            }
        });
    }

    $scope.allPer = function(value) {
        angular.forEach($scope.data.permissions, function(permiso, keyP) {
            permiso.read = value;
            permiso.create = value;
            permiso.edit = value;
            permiso.destroy = value;
        });
    }

    $scope.allRow = function(index, value) {
        $scope.data.permissions[index].read = value;
        $scope.data.permissions[index].create = value;
        $scope.data.permissions[index].edit = value;
        $scope.data.permissions[index].destroy = value;
    }

    $scope.setAction();
});
