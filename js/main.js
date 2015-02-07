var rfa = angular.module(
    'RFA',
    ['ngRoute']
);

rfa.config(['$routeProvider',
    function($routeProvider) {
        $routeProvider.
        when('/queue', {
            templateUrl: 'pages/queue.html',
        })
        .otherwise({
            redirectTo: '/queue'
        });
    }]
);
