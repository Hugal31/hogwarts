var hogwartsApp = angular.module('hogwartsApp', ['ngCookies']);

// Short house name
hogwartsApp
    .filter('shortHouse', function () {
        return function (house) {
            return house.substr(0, 3);
        };
    })
    .filter('capitalize', function() {
        return function(input) {
            return (!!input) ? input.charAt(0).toUpperCase() + input.substr(1).toLowerCase() : '';
        }
    });

hogwartsApp.controller('HourglassController', function ($scope, $http, $interval) {

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

hogwartsApp.controller('AdminController', function ($scope, $cookies, $http) {

    $scope.login = function (email, password) {
        $http.post('/api/v1/auth', {
            email: email,
            password: password
        }).then(function (response) {
            $scope.invalidLogin = false;
            $scope.hasToken = true;
            $scope.token = response.data.key;
            $cookies.put('api_token', $scope.token);
            $scope.updateHistory();
        }, function () {
            $scope.invalidLogin = true;
        });
    };

    $scope.logout = function () {
        $cookies.put('api_token', undefined);
        $scope.hasToken = false;
        $scope.token = null;
    };

    $scope.updateHistory = function () {
        $http.get('/api/v1/operations?key=' + $scope.token).then(function (response) {
            $scope.operations = response.data;
            console.log(response.data);
        });
    };

    $scope.token = $cookies.get('api_token');
    $scope.hasToken = Boolean($scope.token);
    if ($scope.hasToken) {
        $scope.invalidLogin = false;
        $scope.updateHistory();
    }

    $scope.operations = [];

    $scope.loginData = {
        email: '',
        password: ''
    };

});
