<!DOCTYPE html>

<?php
function redirectToLogin()
{
	header("Location: selectUser.php");
	exit();
}

if (!isset($_GET["id"]))
	redirectToLogin();
?>


<html lang="es-BO">
	<head>
	    <title>El ahorcado</title>
		<meta charset="UTF-8">
	    <link rel="stylesheet" type="text/css" href="css/main.css">
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.10/angular.min.js"></script>
	</head>
	<body ng-app="hangman" ng-controller="MainController">		
	    <div>
		    <img class="health" ng-src="{{ 'img/' + health + '.png' }}" />
		</div>

		<div class="userInput" ng-hide="hasFinished()">
		    <div class="revealed">
			  {{ revealed }}
			</div>
			<form ng-submit="submitLetter()">
				<input type ="text"
					   id="letterTextBox"
					   name="letterTextBox"
					   maxlength="1"
					   size="1"
					   ng-model="letter"
					   autofocus />
				<input type ="submit"
					   id="tryButton"
					   name="tryButton"
					   value="Intentar" />


			</form>
		</div>

		<div ng-show="hasFinished()">
			<div ng-show="hasWon">Ganaste</div>
			<div ng-show="!hasWon">Perdiste</div>
			<a href="" ng-click="init()">Volver a jugar</a>
		</div>
        <script>
		  var app = angular.module("hangman", []);

		  app.controller("MainController", ["$scope", "$http", function($scope, $http) {
			$scope.letter = '';
			$scope.health = 6;
			$scope.revealed = "";
			$scope.hasWon = false;

			$scope.hasFinished = function() {
			   return $scope.health == 0 || $scope.hasWon;
			};

			$scope.init = function() {
			   $http.post('play.php').then( processResponse );
			};

			$scope.submitLetter = function() {
			   var data = { letter: $scope.letter };
			   $http.post('play.php', data).then(processResponse);
			   $scope.letter = '';
			};

			$scope.init();

			function processResponse(response) {
			  $scope.hasWon = response.data.hasWon;
			  $scope.health = response.data.health;
			  $scope.revealed = response.data.revealed;
			}
		  }]);


		</script>
	</body>
</html>
