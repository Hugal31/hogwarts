<!DOCTYPE html>
<html lang="en" ng-app="hogwartsApp">
  <head>
    <meta charset="UTF-8">
    <title>Epi Hogwarts</title>
    <link rel="stylesheet" href="/app/app.css"><script
        src="https://code.jquery.com/jquery-3.1.0.min.js"
        integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s="
        crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.min.js"></script>
    <script type="text/javascript" src="/app/app.js"></script>
  </head>
  <body ng-controller="HourglassController">
    <div id="main-wrapper">
      <div class="hourglass" data-house="slytherin">
        <div class="container">
          <div class="house-name">Serpentard</div>
          <div class="hourglass-body">
            <div class="top"></div>
            <div class="middle">
              <div class="sand"></div>
            </div>
            <div class="bottom sand"></div>
          </div>
          <div class="house-crest"><img src="/img/shield_sly.png" alt=""></div>
          <div class="score">{{houses.slytherin.score}} points</div>
        </div>
      </div>
      <div class="hourglass" data-house="ravenclaw">
        <div class="container">
        <div class="house-name">Serdaigle</div>
          <div class="hourglass-body">
            <div class="top"></div>
            <div class="middle">
            <div class="sand"></div>
            </div>
            <div class="bottom sand"></div>
          </div>
          <div class="house-crest"><img src="/img/shield_rav.png" alt=""></div>
          <div class="score">{{houses.ravenclaw.score}} points</div>
        </div>
      </div>
      <div class="hourglass" data-house="gryffindor">
        <div class="container">
          <div class="house-name">Gryffondor</div>
          <div class="hourglass-body">
            <div class="top"></div>
            <div class="middle">
              <div class="sand"></div>
            </div>
            <div class="bottom sand"></div>
          </div>
          <div class="house-crest"><img src="/img/shield_gry.png" alt=""></div>
          <div class="score">{{houses.gryffindor.score}} points</div>
        </div>
      </div>
      <div class="hourglass" data-house="hufflepuff">
        <div class="container">
          <div class="house-name">Poufsouffle</div>
          <div class="hourglass-body">
            <div class="top"></div>
            <div class="middle">
              <div class="sand"></div>
            </div>
            <div class="bottom sand"></div>
          </div>
          <div class="house-crest"><img src="/img/shield_huf.png" alt=""></div>
          <div class="score">{{houses.hufflepuff.score}} points</div>
        </div>
      </div>
    </div>
  </body>
</html>
