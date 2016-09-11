var hogwartsApp = angular.module('hogwartsApp', []);

hogwartsApp.controller('HourglassController', function HourglassController($scope, $http, $interval) {

    $scope.interval = 30000;
    $scope.maxScore = 200;
    $scope.houses = [];

    $scope.update = function () {

        var calcMaxScore = function (houses) {
            var max = 0;
            houses.forEach(function (house) {
                max = Math.max(max, house.score);
            });
            var maxScore = 200;
            while (maxScore < max)
                maxScore += 200;
            return maxScore;
        };

        $http.get('/api/v1/houses').then(function(response) {
            $scope.maxScore = calcMaxScore(response.data);
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
