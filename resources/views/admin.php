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

        <div id="admin">
          <form name="houseOperationForm" ng-submit="submitHouseOperationForm()">
            <label for="houseSelect">
              House:
              <img src="/img/shield_{{houseOperationData.house | shortHouse}}.png" alt="House's shield" class="small">
            </label>
            <select name="house" id="houseSelect" ng-model="houseOperationData.house">
              <option value="slytherin">Slytherin</option>
              <option value="ravenclaw">Ravenclaw</option>
              <option value="gryffindor">Gryffindor</option>
              <option value="hufflepuff">Hufflepuff</option>
            </select>
            <label for="actionSelect">Action:</label>
            <select name="action" id="actionSelect" ng-model="houseOperationData.action">
              <option value="add">Add</option>
              <option value="remove">Remove</option>
              <option value="set">Set</option>
            </select>
            <label for="amount">Amount:</label>
            <input type="number" name="amount" id="amountInput" ng-model="houseOperationData.amount" required/>
            <textarea name="reason" id="reasonInput" cols="30" rows="10" ng-model="houseOperationData.reason"></textarea>
            <input type="submit" value="Submit">
          </form>
        </div>

        <div id="operations">
          <table border="1" cellpadding="8" class="operations">
            <thead>
              <tr>
                <td>User</td>
                <td>House</td>
                <td>Operation</td>
                <td>Amount</td>
                <td>Date</td>
                <td>Reason</td>
              </tr>
            </thead>
            <tbody ng-repeat="operation in operations">
              <tr>
                <td>{{operation.user.name}}</td>
                <td>
                  <img src="/img/shield_{{operation.house.name | shortHouse}}.png" alt="House's shield" class="small"/>
                  {{operation.house.name | capitalize}}
                </td>
                <td>{{operation.action}}</td>
                <td>{{operation.amount}}</td>
                <td>{{operation.updated_at}}</td>
                <td>{{operation.reason}}</td>
              </tr>
            </tbody>
          </table>
        </div>
        <button ng-click="logout()">Log out</button>
      </div>
    </div>
  </body>
</html>
