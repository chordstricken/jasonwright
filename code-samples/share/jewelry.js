Public.controller('Jewelry', function($scope, $http, Config) {
    $scope.show_loader   = true;
    $scope.items         = [];
    $scope.items_to_show = 20;
    $scope.query         = {};

    $scope.timeout    = undefined;
    $scope.load_table = function() {
        clearTimeout($scope.timeout);
        $scope.show_loader   = true;
        $scope.items         = [];
        $scope.items_to_show = 20;

        // set a small timeout in case many triggers are called successively (typing, for example)
        $scope.timeout = setTimeout(function() {
            $http.post('/xhr/jewelry', $scope.query).success(function(data) {
                var key, i = 1;
                for (key in data) {
                    data[key].index = i++;
                }

                $scope.items       = data;
                $scope.show_loader = false;

            }).error(function(data) {
                $scope.items = [];
                $scope.show_loader = false;

            });
        }, 600);
    }

    $scope.load_table();

    // shows the next 20 items
    $scope.show_more = function() {
        $scope.items_to_show = $scope.items_to_show + 20
    }

});