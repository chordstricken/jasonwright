Public.controller('Home', function($scope, $http, Config) {
    $scope.phonenumber    = Config.phonenumber;
    $scope.featured_items = [];

    $http.get('/xhr/featured').success(function(data) {
        $scope.featured_items = data;

    }).error(function(data) {
        $scope.featured_items = [];

    });
});