var rfa = angular.module(
    'RFA',
    ['ngRoute', 'capi']
);

LOGIN_RESOLVER = {
    current_user: ['capi.ums', function(ums) {
        return ums.get_current_user();
    }]
};

rfa.config(['$routeProvider',
    function($routeProvider) {
        $routeProvider.
        when('/form', {
            templateUrl: 'pages/form.html',
            controller: 'formController',
            resolve: LOGIN_RESOLVER
        })
        .when('/queue', {
            templateUrl: 'pages/queue.html',
            controller: 'QueueController',
            resolve: LOGIN_RESOLVER
        })
        .when('/queue/:id', {
            templateUrl: 'pages/details.html',
            controller: 'DetailsController',
            resolve: LOGIN_RESOLVER
        })
        .otherwise({
            redirectTo: '/queue'
        });
    }]
);

rfa.controller('formController', formController);

// define angular module/app
function formController($scope, $http, $location, current_user) {
    //init
    $scope.isDisabled = undefined;
    $scope.modalShown = undefined;
    $scope.formData = {};

    $scope.disable = function(){
        //get selected type of rfa
        $rfatype = $scope.formData.rfatype;
        //if ICC's disable form and prompt user to URL
        if($rfatype ==  3){
            $scope.isDisabled = true;
        }else{
            $scope.isDisabled = false;
        }
        
    }

    // process the form
    $scope.submitForm = function() {
        $http({
            method  : 'POST',
            url     : '~/rfa/submitrfa!',
            data    : $scope.formData,  // pass in data as strings
            //headers : { 'Content-Type': 'application/x-www-form-urlencoded' }  // set the headers so angular passing info as form data (not request payload)
        })
            .success(function(data) {
                //console.log(data);
                if (!data.success) {
                    // if not successful, bind errors to error variables for validation
                    console.log(data.errors);
                    $scope.errorrfatype = data.errors.rfatype;
                    $scope.errordescrip = data.errors.descrip;
                } else {                  
                    // if successful, send to database, comeback and redirect
                    $location.path('/queue')
                }
            });
    };
}

rfa.controller('QueueController', ['$scope', '$http', '$location', 'current_user', '$resource',
    function($scope, $http, $location, current_user, $resource) {
        var Queue = $resource('~/rfa/queue!');
        $scope.queues = Queue.query();
    }]
);

rfa.controller('DetailsController', ['$scope', '$http', '$location', 'current_user', '$resource', '$routeParams',
    function($scope, $http, $location, current_user, $resource, $routeParams) {
        var Detail = $resource('~/rfa/queue!?id=:id', {'id': '@id'});  // add url when api is up
        $scope.rfa_entry = Detail.get({id: $routeParams.id});
        $scope.rfa_id = $routeParams.id;
    }]

);
