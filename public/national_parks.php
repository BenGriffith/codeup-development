<?php

	// Get new instance of MySQLi object
	$mysqli = new mysqli('127.0.0.1', 'codeup', 'password', 'codeup_mysqli_test_db');

	// Check for errors
	if ($mysqli->connect_errno) {
		throw new Exception('Failed to connect to MySQl: (' . $mysqli->connect_errno . ')' . $mysqli->connect_error);
	}

	// Retrieve a result set using SELECT
	$result = $mysqli->query("SELECT name, location, description, date_established, area_in_acres FROM national_parks");

	// Use print_r() to show rows using MYSQLI_ASSOC
	while ($row = $result->fetch_row()) {
	    $rows[] = $row;
	}

	$sort_name_asc = $mysqli->query("SELECT name FROM national_parks ORDER BY ASC");

	// $sorting_actions = array($sort_name_asc);

	// if (isset($_GET['sort_asc'])) {
	// 	return $sorting_actions[0];
	// 	header('Location: national_parks.php');
	// }

?>


<!DOCTYPE html>
<html>
	<head>
		<title>National Parks List</title>
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="container fixed">
			<h1>National Parks</h1>
			
		</div>
			

		<div class="container fluid">
			

			<table class="table table-hover">
				<tr>
					<td>Name <a href="?sort_asc">Sort</a></td>
					<td>Location<a href=>Sort</a></td>
					<td>Description</td>
					<td>Date Established<a href>Sort</a></td>
					<td>Area in Acres</td>
				</tr>

				<?
					foreach ($rows as $row) {
						echo "<tr></tr>";
						foreach ($row as $park_stats) {
							echo "<td>$park_stats</td>";
						}
					}

				?>
			
		</div>

		</table>
	</body>
</html>