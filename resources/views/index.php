<!DOCTYPE html>
<html lang="en" ng-app="hogwartsApp">
  <head>
    <meta charset="UTF-8">
    <title>Epi Hogwarts</title>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.min.js"></script>
    <script type="text/javascript" src="/app/app.js"></script>
  </head>
  <body ng-controller="HourglassController">
    <div>Gryffondor : {{houses.gryffindor.score}} points</div>
    <div>Poufsouffle : {{houses.hufflepuff.score}} points</div>
    <div>Serdaigle : {{houses.ravenclaw.score}} points</div>
    <div>Serpentard : {{houses.slytherin.score}} points</div>
  </body>
</html>
