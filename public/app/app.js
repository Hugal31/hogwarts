var hogwartsApp = angular.module('hogwartsApp', []);

hogwartsApp.controller('HourglassController', function HourglassController($scope, $http) {
    $http.get('/api/v0/houses').then(function(response) {
        $scope.houses = response.data.houses;
    });
});
