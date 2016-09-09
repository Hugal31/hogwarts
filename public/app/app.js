var hogwartsApp = angular.module('hogwartsApp', []);

hogwartsApp.controller('HourglassController', function HourglassController($scope, $http, $interval) {

    $scope.houses = [];

    $scope.update = function () {
        $http.get('/api/v0/houses').then(function(response) {
            response.data.forEach(function (house) {
                $scope.houses[house.name] = house;
            });
        });
    };

    $scope.update();

    // Refresh every minute
    $interval($scope.update, 60000);
});
