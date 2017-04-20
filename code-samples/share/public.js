var Public = angular.module('Public', []);

// standard configs
Public.factory('Config', function() {
    return {
        phonenumber: '1-800-969-7038'
    }
});

Public.controller('Nav', function($scope, Config) {
    $scope.page        = window.location.pathname;
    $scope.phonenumber = Config.phonenumber;
});

/**
 * Counts the number of items in an object or array
 * @param Array or Object
 * @returns Number
 */
function count(param)
{
    if (param instanceof Array) {
        return param.length;
    } else if (param instanceof Object) {
        return Object.keys(param).length;
    } else {
        return 0;
    }
}
