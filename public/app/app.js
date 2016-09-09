var hogwartsApp = angular.module('hogwartsApp', []);

hogwartsApp.controller('HourglassController', function HourglassController($scope, $http, $interval) {

    $scope.interval = 30000;
    $scope.maxScore = 500;
    $scope.houses = [];

    $scope.update = function () {
        $http.get('/api/v0/houses').then(function(response) {
            response.data.forEach(function (house) {
                $scope.houses[house.name] = house;
                var maxHeight = parseInt($('.hourglass[data-house="' + house.name + '"] .hourglass-body .middle').css('height'));
                $('.hourglass[data-house="' + house.name + '"] .hourglass-body .middle .sand').css('height', maxHeight * house.score / $scope.maxScore);
            });
        });
    };

    $scope.update();

    // Refresh every minute
    $interval($scope.update, $scope.interval);
});
