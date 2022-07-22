var app = angular.module('seadust', []);

app.run(function($http) {

	//PARA QUE LARAVEL RECONOSCA QUE ES UNA PETICION POR MEDIO DE AJAX
  	$http.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

});

app.directive("datetimepicker", function () {
    return {
        restrict: "A",
        link: function (scope, el, attrs) {
            $(el).datetimepicker({
                locale : 'es',
                format : 'DD-MM-YYYY',
                showClear : true,
            });
            $(el).on("dp.change", function (e) {
                scope.$eval(attrs.ngModel + "='" + el.val() + "'");
            });
        }
    }
});
