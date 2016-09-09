<!DOCTYPE html>
<html lang="en" ng-app="hogwartsApp">
  <head>
    <meta charset="UTF-8">
    <title>Epi Hogwarts</title>
    <link rel="stylesheet" href="/app/app.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.min.js"></script>
    <script type="text/javascript" src="/app/app.js"></script>
  </head>
  <body ng-controller="HourglassController">
    <div id="main-wrapper">
      <div class="hourglass">
        <div class="house-name">Serpentard</div>
        <div class="house-crest"><img src="/img/shield_sly.jpg" alt=""></div>
        <div class="score">{{houses.slytherin.score}} points</div>
      </div>
      <div class="hourglass">
        <div class="house-name">Serdaigle</div>
        <div class="house-crest"><img src="/img/shield_rav.jpg" alt=""></div>
        <div class="score">{{houses.ravenclaw.score}} points</div>
      </div>
      <div class="hourglass">
        <div class="house-name">Gryffondor</div>
        <div class="house-crest"><img src="/img/shield_gry.jpg" alt=""></div>
        <div class="score">{{houses.gryffindor.score}} points</div>
      </div>
      <div class="hourglass">
        <div class="house-name">Poufsouffle</div>
        <div class="house-crest"><img src="/img/shield_huf.jpg" alt=""></div>
        <div class="score">{{houses.hufflepuff.score}} points</div>
      </div>
    </div>
  </body>
</html>
