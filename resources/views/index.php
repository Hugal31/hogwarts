<!DOCTYPE html>
<html lang="en" ng-app="hogwartsApp">
  <head>
    <meta charset="UTF-8">
    <title>Epi Hogwarts</title>
    <link rel="stylesheet" href="/app/app.css">
    <link rel="stylesheet" href="/app/hourglass.css">
    <script src="https://code.jquery.com/jquery-3.1.0.min.js"
            integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s="
            crossorigin="anonymous"></script>
    <script type="text/javascript" src="/app/components/angular.min.js"></script>
    <script type="text/javascript" src="/app/components/angular-cookies.min.js""></script>
    <script type="text/javascript" src="/app/components/angular-translate.min.js""></script>
    <script type="text/javascript" src="/app/app.js"></script>
  </head>
  <body ng-controller="HourglassController">
    <div id="main-wrapper">
      <div class="hourglass" ng-repeat="house in ['slytherin', 'ravenclaw', 'gryffindor', 'hufflepuff']" data-house="{{house}}">
        <div class="container">
          <div class="house-name capitalize">{{house | translate}}</div>
          <div class="hourglass-body">
            <div class="top"></div>
            <div class="middle-top"></div>
            <div class="middle">
              <div class="sand"></div>
            </div>
            <div class="bottom sand"></div>
          </div>
          <div class="house-crest"><img src="/img/shield_{{house|shortHouse}}.png" alt=""></div>
          <div class="score">{{houses[house].score}} points</div>
        </div>
      </div>
    </div>
  </body>
</html>
