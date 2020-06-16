<?php
session_start();
$user=$_SESSION['idloged'];
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Cotizaciones</title>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
	<!--<base href="/Varios/cotizaciones/">-->
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css" />
		<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
		<link rel="stylesheet" type="text/css" href="css/app.css" />

	</head>
	<body ng-app="cotizaciones">
		<nav ng-controller="navCtrl as nav">
			<ul class="nav nav-tabs nav-justified">
				<li ng-class="{active: nav.estoy('/')}" role="presentation"><a href="#/">Listado de Cotizaciones</a></li>
				<li ng-class="{active: nav.estoy('/crearCot')}" role="presentation"><a href="#/crearCot/">Nueva Cotizaci&oacute;n</a></li>
			</ul>
		</nav>

		<div id="cont" ng-view></div>

	</body>

	<script type="text/javascript" src="js/angular.min.js"></script>
	<script type="text/javascript" src="js/angular-route.min.js"></script>
	<script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/app.js"></script>
	
</html>

