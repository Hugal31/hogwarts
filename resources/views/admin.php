<!DOCTYPE html>
<html lang="en" ng-app="hogwartsApp">
  <head>
    <meta charset="UTF-8">
    <title>Epi Hogwarts</title>
    <link rel="stylesheet" href="/app/admin.css">
    <script src="https://code.jquery.com/jquery-3.1.0.min.js"
            integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s="
            crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular-cookies.min.js"></script>
    <script type="text/javascript" src="/app/app.js"></script>
  </head>
  <body ng-controller="AdminController">
    <div id="main-wrapper" ng-switch="hasToken">
      <div ng-switch-default>
        <form name="loginForm" ng-submit="login(loginData.email, loginData.password)">
          <label for="email">Email :</label>
          <input type="email" name="email" id="email" ng-model="loginData.email" required>
          <label for="password">Password : </label>
          <input type="password" name="password" id="password" ng-model="loginData.password" required>
          <input type="submit" value="Log in">
        </form>
        <p ng-if="invalidLogin">
          Invalid email/password combination
        </p>
      </div>
      <div ng-switch-when="true">
        <div id="admin"></div>
        <div id="operations">
          <table border="1" cellpadding="8">
            <thead>
              <tr>
                <td>Name</td>
                <td>House</td>
                <td>Operation</td>
                <td>Amount</td>
                <td>Date</td>
              </tr>
            </thead>
            <tbody ng-repeat="operation in operations">
              <tr>
                <td>{{operation.user.name}}</td>
                <td>{{operation.house.name | capitalize}}</td>
                <td>{{operation.action}}</td>
                <td>{{operation.amount}}</td>
                <td>{{operation.updated_at}}</td>
              </tr>
            </tbody>
          </table>
        </div>
        <button ng-click="logout()">Log out</button>
      </div>
    </div>
  </body>
</html>
