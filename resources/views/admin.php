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

        <div id="adminOperations">
          <h2>Admin panel</h2>
          <div id="houseOperation">
            <h3>Change points</h3>
            <form name="houseOperationForm" ng-submit="submitHouseOperationForm()" class="capitalize">
              <div>
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
              </div>
              <div>
                <label for="actionSelect">{{'operation'|translate}}:</label>
                <select name="action" id="actionSelect" ng-model="houseOperationData.action">
                  <option value="add">{{'add'|translate}}</option>
                  <option value="remove">{{'remove'|translate}}</option>
                  <option value="set">{{'set'|translate}}</option>
                </select>
              </div>
              <div>
                <label for="amountInput">{{'amount'|translate}}:</label>
                <input type="number" name="amount" id="amountInput" ng-model="houseOperationData.amount" required/>
              </div>
              <div>
                <label for="reasonInput">{{'reason'|translate}}</label>
                <textarea name="reason" id="reasonInput" cols="30" rows="10" ng-model="houseOperationData.reason"></textarea>
              </div>
              <input type="submit">
            </form>
          </div>

          <div id="create_user" ng-if="user.admin">
            <h3>Create user</h3>
            <form name="createUserForm" class="capitalize" ng-submit="submitCreateUserForm()">
              <div>
                <label for="inputUserName">User name</label>
                <input type="text" id="inputUserName" ng-model="createUserData.name" required>
              </div>
              <div>
                <label for="inputUserEmail">Email</label>
                <input type="email" id="inputUserEmail" ng-model="createUserData.email" required autocomplete="off">
              </div>
              <div>
                <label for="inputIsAdmin">Is superadmin</label>
                <input type="checkbox" id="inputIsAdmin" ng-model="createUserData.admin">
              </div>
              <div>
                <label for="inputUserPassword">Password</label>
                <input type="password" id="inputUserPassword" ng-model="createUserData.password" required autocomplete="off">
              </div>
              <input type="submit">
            </form>

            <div class="error">
              <p ng-repeat="error in createUserData.errors">{{error}}</p>
            </div>
          </div>
        </div>

        <div id="operations">
          <h2>Operations</h2>
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
                  <span class="valign-shield">{{operation.house.name | translate}}</span>
                </td>
                <td>{{operation.action | translate}}</td>
                <td>{{operation.amount}}</td>
                <td>{{operation.updated_at}}</td>
                <td>{{operation.reason}}</td>
              </tr>
            </tbody>
          </table>
        </div>

        <div id="change_password">
          <h3>Change password</h3>
          <form name="changePasswordForm" class="capitalize" ng-submit="submitChangePasswordForm()">
            <div>
              <label for="inputUserPassword">Password</label>
              <input type="password" id="inputUserPassword" ng-model="changePasswordData.password" required autocomplete="off">
            </div>
            <div>
              <label for="inputUserPasswordConfirm">Confirm password</label>
              <input type="password" id="inputUserPasswordConfirm" ng-model="changePasswordData.confirm_password" required autocomplete="off">
            </div>
            <input type="submit">
          </form>

          <div class="error">
            <p ng-repeat="error in changePasswordData.errors">{{error}}</p>
          </div>
        </div>

        <button ng-click="logout()">Log out</button>
      </div>
    </div>
  </body>
</html>
