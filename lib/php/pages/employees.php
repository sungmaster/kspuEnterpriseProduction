<!DOCTYPE html>
<html>
	<head>
		<title>Our employees</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	</head>
	<body>
		<div class="container">
			<h2><span class="glyphicon glyphicon-user"></span>Our Employees</h2>
			<div class="row">
				<div class="col-md-3">
				<ul>
					<?php
					foreach ($persons as $pers) {
						echo '<li>';
						echo '<a href="', $_SERVER['SCRIPT_NAME'], '/PageController/getPersonByName/', $pers['name'], '">', $pers['name'], '</a><br>';
						echo $pers['adress'], '<br>';
						echo '--<a href="', $_SERVER['SCRIPT_NAME'], '/PageController/getPersonsByCity/', $pers['city'], '">', $pers['city'], '</a>';
						echo '</li>';
					}
					?>
				</ul>
				</div><!--end col-->
				<div class="col-md-5">
				<ul>
					<?php
					if (isset($person)) {
						echo 'More info about choosen person:';
						echo '<li>';
						echo '<a href="', $_SERVER['SCRIPT_NAME'], '/PageController/getPersonByName/', $person['name'], '">', $person['name'], '</a><br></li>';
						echo '<li>', $person['adress'], '</li>';
						echo '<li>', $person['city'], '</li>';
					}
					if (isset($personsInCities)) {
						echo 'These persons are located in: <b>', $personsInCities[0]['city'], '</b>';
						foreach ($personsInCities as $pers) {
							echo '<li>';
							echo '<a href="', $_SERVER['SCRIPT_NAME'], '/PageController/getPersonByName/', $pers['name'], '">', $pers['name'], ' </a>';
							echo $pers['adress'], ' ';
							echo $pers['city'];
							echo '</li>';
						}
					}
					?>
				</ul>
				</div><!--end col-->
			</div><!--end row-->
		</div>
	</body>
</html>