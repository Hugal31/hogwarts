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
    <script type="text/javascript" src="/app/components/angular-cookies.min.js"></script>
    <script type="text/javascript" src="/app/components/angular-translate.min.js"></script>
    <script type="text/javascript" src="/app/config.js"></script>
    <script type="text/javascript" src="/app/app.js"></script>
  </head>
  <body ng-controller="HourglassController">
    <div id="main-wrapper">
      <div id="main-container">
        <div id="hourglasses-container">
          <div class="hourglass" ng-repeat="house in ['slytherin', 'ravenclaw', 'gryffindor', 'hufflepuff']"
               data-house="{{house}}" data-place="{{houses[house].place}}">
            <div class="container">
              <div class="hourglass-body">
                <div class="top">
                  <div class="sand"></div>
                  <div class="hourglass-top">
                    <div class="score">{{houses[house].score}}</div>
                  </div>
                </div>
                <div class="middle">
                  <div class="sand" style="max-height:100%;height:calc(50px + 100% * {{houses[house].score / maxScore}});">
                    <div class="glass"></div>
                  </div>
                </div>
              </div>
              <div class="house-crest"><img src="/img/shield_{{house|shortHouse}}.png" alt=""></div>
            </div>
          </div>
        </div>
        <div id="announce-container">
          <div id="announce">
            <h2>Information WEI</h2>
            <p>Rendez-vous demain 7h30.</p>
            <p>Pensez à amener:</p>
            <ul>
              <li>Un pic-nique pour le midi</li>
              <li>Un maillot de bain</li>
              <li>Un sac de couchage / tapis de sol / tente</li>
              <li>Des vêtements salissables</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
