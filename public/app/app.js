var hogwartsApp = angular.module('hogwartsApp', ['ngCookies', 'pascalprecht.translate']);

// Short house name
hogwartsApp
    .filter('shortHouse', function () {
        return function (house) {
            return house.substr(0, 3);
        };
    });

hogwartsApp.config(function ($translateProvider) {
    $translateProvider.translations('fr', {
	'slytherin': 'serpentard',
	'ravenclaw': 'serdaigle',
	'gryffindor': 'gryffondor',
	'hufflepuff': 'poufsouffle',
	'house': 'maison',
	'user': 'utilisateur',
	'operation': 'operation',
	'amount': 'montant',
	'reason': 'raison',
	'add': 'ajouter',
	'remove': 'retirer',
	'set': 'fixer'
    });
});

hogwartsApp.controller('HourglassController', function ($scope, $http, $interval, $translate) {

    $translate.use('fr'); // TODO Change

    $scope.interval = 30000;
    $scope.scoreStep = 1000;
    $scope.maxScore = 1000;
    $scope.houses = {
        slytherin: {
            score: 0
        },
        ravenclaw: {
            score: 0
        },
        gryffindor: {
            score: 0
        },
        hufflepuff: {
            score: 0
        }
    };

    $scope.update = function () {

        var calcBestScore = function (houses) {
            var best = 0;
            houses.forEach(function (house) {
                best = Math.max(best, house.score);
            });
            return best;
        };

        var calcMaxScore = function (houses, max) {
            var maxScore = $scope.scoreStep;
            while (maxScore < max)
                maxScore += $scope.scoreStep;
            return maxScore;
        };

        $http.get('/api/v1/houses').then(function(response) {
            var bestScore = calcBestScore(response.data);
            $scope.maxScore = calcMaxScore(response.data, bestScore);
            response.data.forEach(function (house, index) {
                house.place = index + 1;
                $scope.houses[house.name] = house;
            });
        });
    };

    $scope.update();

    // Refresh scores
    $interval($scope.update, $scope.interval);
});

hogwartsApp.controller('AdminController', function ($scope, $cookies, $http, $translate) {

    $translate.use('fr'); // TODO Change

    $scope.operations = [];

    $scope.loginData = {
        email: '',
        password: ''
    };

    $scope.user = {
        name: undefined,
        email: undefined,
        admin: false
    };

    $scope.houseOperationData = {
        house: "slytherin",
        action: "add",
        amount: undefined,
        reason: ''
    };

    $scope.createUserData = {
        name: '',
        email: '',
        password: '',
        admin: false,
        errors: {}
    };

    $scope.getUser = function () {
        $http.get('/api/v1/user?key=' + $scope.token).then(function (response) {
            $scope.user = response.data;
        });
    };

    $scope.login = function (email, password) {
        $http.post('/api/v1/auth', {
            email: email,
            password: password
        }).then(function (response) {
            $scope.invalidLogin = false;
            $scope.hasToken = true;
            $scope.token = response.data.key;
            $cookies.put('api_token', $scope.token);
            $scope.getUser();
            $scope.updateOperations();
        }, function () {
            $scope.invalidLogin = true;
        });
    };

    $scope.logout = function () {
        $cookies.put('api_token', undefined);
        $scope.hasToken = false;
        $scope.token = null;
    };

    $scope.updateOperations = function () {
        $http.get('/api/v1/operations?key=' + $scope.token).then(function (response) {
            $scope.operations = response.data;
        });
    };

    $scope.houseOperation = function (house, action, amount, reason) {
        $http.put('/api/v1/houses/' + house, {
            action: action,
            amount: amount,
            key: $scope.token,
            reason: reason
        }).then(function () {
            $scope.updateOperations();
        });
    };

    $scope.submitHouseOperationForm = function() {
        $scope.houseOperation($scope.houseOperationData.house,
            $scope.houseOperationData.action,
            $scope.houseOperationData.amount,
            $scope.houseOperationData.reason);
        $scope.houseOperationData.amount = 0;
        $scope.houseOperationData.action = 'add';
        $scope.houseOperationData.reason = null;
    };

    $scope.createUser = function (name, email, password, admin) {
        $http.post('/api/v1/users', {
            name: name,
            email: email,
            password: password,
            admin: admin,
            key: $scope.token
        }).then(function () {}, function (response) {
            $scope.createUserData.errors = response.data[Object.keys(response.data)[0]][0];
        });
    };

    $scope.submitCreateUserForm = function () {
        $scope.createUserData.error = '';
        $scope.createUser($scope.createUserData.name,
            $scope.createUserData.email,
            $scope.createUserData.password,
            $scope.createUserData.admin
        );
        $scope.createUserData.name = '';
        $scope.createUserData.email = '';
        $scope.createUserData.password = '';
        $scope.createUserData.admin = false;
    };

    $scope.token = $cookies.get('api_token');
    $scope.hasToken = Boolean($scope.token);
    if ($scope.hasToken) {
        $scope.invalidLogin = false;
        $scope.getUser();
        $scope.updateOperations();
    }
});
