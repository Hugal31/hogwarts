var hogwartsApp = angular.module('hogwartsApp', []);

hogwartsApp.controller('HourglassController', function HourglassController($scope, $http, $interval) {

    $scope.update = function () {
        $http.get('/api/v0/houses').then(function(response) {
            $scope.houses = response.data.houses;
        });
    };

    $scope.update();

    // Refresh every minute
    $interval($scope.update, 60000);
});
