var rfa = angular.module(
    'RFA',
    ['ngRoute']
);

rfa.config(['$routeProvider',
    function($routeProvider) {
        $routeProvider.
        when('/queue', {
            templateUrl: 'pages/form.html',
        })
        .otherwise({
            redirectTo: '/queue'
        });
    }]
);


rfa.controller('formController', formController);

// define angular module/app
function formController($scope, $http) {
    $scope.formData = {};
    // process the form
    $scope.submitForm = function() {
        $http({
            method  : 'POST',
            url     : 'pages/confirmation.php',
            data    : $.param($scope.formData),  // pass in data as strings
            headers : { 'Content-Type': 'application/x-www-form-urlencoded' }  // set the headers so angular passing info as form data (not request payload)
        })
            .success(function(data) {
                console.log(data);
                if (!data.success) {
                    // if not successful, bind errors to error variables
                    $scope.errorrfatype = data.errors.rfatype;
                    $scope.errordescrip = data.errors.descrip;
                } else {
                    // if successful, bind success message to message
                    $scope.message = data.message;
                }
            });
    };
}
