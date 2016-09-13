<!DOCTYPE html>
<html lang="en" ng-app="hogwartsApp">
  <head>
    <meta charset="UTF-8">
    <title>Epi Hogwarts</title>
    <link rel="stylesheet" href="/app/app.css">
    <link rel="stylesheet" href="/app/admin.css">
    <script src="https://code.jquery.com/jquery-3.1.0.min.js"
            integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s="
            crossorigin="anonymous"></script>
    <script type="text/javascript" src="/app/components/angular.min.js"></script>
    <script type="text/javascript" src="/app/components/angular-cookies.min.js""></script>
    <script type="text/javascript" src="/app/components/angular-translate.min.js""></script>
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
          <form name="houseOperationForm" ng-submit="submitHouseOperationForm()" class="capitalize">
            <label for="houseSelect">
              {{'house'|translate}}:
              <img src="/img/shield_{{houseOperationData.house | shortHouse}}.png" alt="House's shield" class="small">
            </label>
            <select name="house" id="houseSelect" ng-model="houseOperationData.house">
              <option value="slytherin">{{'slytherin' | translate}}</option>
              <option value="ravenclaw">{{'ravenclaw' | translate}}</option>
              <option value="gryffindor">{{'gryffindor' | translate}}</option>
              <option value="hufflepuff">{{'hufflepuff' | translate}}</option>
            </select>
            <label for="actionSelect">{{'operation'|translate}}:</label>
            <select name="action" id="actionSelect" ng-model="houseOperationData.action">
              <option value="add">{{'add'|translate}}</option>
              <option value="remove">{{'remove'|translate}}</option>
              <option value="set">{{'set'|translate}}</option>
            </select>
            <label for="amountInput">{{'amount'|translate}}:</label>
            <input type="number" name="amount" id="amountInput" ng-model="houseOperationData.amount" required/>
            <label for="reasonInput">{{'reason'|translate}}</label>
            <textarea name="reason" id="reasonInput" cols="30" rows="10" ng-model="houseOperationData.reason"></textarea>
            <input type="submit" value="Submit">
          </form>
        </div>

        <div id="operations">
          <table border="1" cellpadding="8" class="operations">
            <thead class="capitalize">
              <tr>
                <td>{{'user'|translate}}</td>
                <td>{{'house'|translate}}</td>
                <td>{{'operation'|translate}}</td>
                <td>{{'amount'|translate}}</td>
                <td>{{'date'|translate}}</td>
                <td>{{'reason'|translate}}</td>
              </tr>
            </thead>
            <tbody>
              <tr ng-repeat="operation in operations">
                <td>{{operation.user.name}}</td>
                <td class="capitalize">
                  <img src="/img/shield_{{operation.house.name | shortHouse}}.png" alt="House's shield" class="small"/>
                  {{operation.house.name | translate}}
                </td>
                <td>{{operation.action | translate}}</td>
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
