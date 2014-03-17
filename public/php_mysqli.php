<?php

	// Get new instance of MySQLi object
	$mysqli = new mysqli('127.0.0.1', 'codeup', 'password', 'codeup_mysqli_test_db');

	// Check for errors
	if ($mysqli->connect_errno) {
		throw new Exception('Failed to connect to MySQl: (' . $mysqli->connect_errno . ')' . $mysqli->connect_error);
	}

	// Create the query and assign to var
	$query = 'CREATE TABLE national_parks (
		id INT NOT NULL AUTO_INCREMENT,
		name VARCHAR(50) NOT NULL,
		location VARCHAR(50) NOT NULL,
		description VARCHAR(300) NOT NULL,
		date_established VARCHAR(50) NOT NULL,
		area_in_acres INT NOT NULL,
		PRIMARY KEY (id)
	);';

	$national_parks = [
		['park_name' => 'Acadia', 				'park_location' => 'Maine', 			'park_description' => 'Covering most of Mount Desert Island and other coastal islands, Acadia features the tallest mountain on the Atlantic coast of the United States, granite peaks, ocean shoreline, woodlands, and lakes. There are freshwater, estuary, forest, and intertidal habitats.', 																				'park_date' => 'February 26, 1919', 	'park_area' => '47,389'],
		['park_name' => 'American Samoa', 		'park_location' => 'American Samoa',	'park_description' => 'The southernmost national park is on three Samoan islands and protects coral reefs, rainforests, volcanic mountains, and white beaches. The area is also home to flying foxes, brown boobies, sea turtles, and 900 species of fish.', 																													'park_date' => 'October 31, 1988', 		'park_area' => '9,000'],
		['park_name' => 'Arches', 				'park_location' => 'Utah', 				'park_description' => 'This site features more than 2,000 natural sandstone arches, including the Delicate Arch. In a desert climate millions of years of erosion have led to these structures, and the arid ground has life-sustaining soil crust and potholes, natural water-collecting basins. Other geologic formations are stone columns, spires, fins, and towers.', 		'park_date' => 'November 12, 1971', 	'park_area' => '76,518'],
		['park_name' => 'Badlands', 			'park_location' => 'South Dakota', 		'park_description' => 'The Badlands are a collection of buttes, pinnacles, spires, and grass prairies. It has the world\'s richest fossil beds from the Oligocene epoch, and there is wildlife including bison, bighorn sheep, black-footed ferrets, and swift foxes.', 																										'park_date' => 'November 10, 1978', 	'park_area' => '242,755'],
		['park_name' => 'Big Bend', 			'park_location' => 'Texas', 			'park_description' => 'Named for the Bend of the Rio Grande along the US–Mexico border, this park includes a part of the Chihuahuan Desert. A wide variety of Cretaceous and Tertiary fossils as well as cultural artifacts of Native Americans exist within its borders.', 																									'park_date' => 'June 12, 1944', 		'park_area' => '801,163'],
		['park_name' => 'Biscayne', 			'park_location' => 'Florida', 			'park_description' => 'Located in Biscayne Bay, this park at the north end of the Florida Keys has four interrelated marine ecosystems: mangrove forest, the Bay, the Keys, and coral reefs. Threatened animals include the West Indian Manatee, American crocodile, various sea turtles, and peregrine falcon.', 																'park_date' => 'June 28, 1980', 		'park_area' => '172,924'],
		['park_name' => 'Bryce Canyon', 		'park_location' => 'Utah', 				'park_description' => 'Bryce Canyon is a giant natural amphitheatre along the Paunsaugunt Plateau. The unique area has hundreds of tall sandstone hoodoos formed by erosion. The region was originally settled by Native Americans and later by Mormon pioneers.', 																												'park_date' => 'February 25, 1928', 	'park_area' => '35,835'],
		['park_name' => 'Canyonlands', 			'park_location' => 'Utah', 				'park_description' => 'This landscape was eroded into canyons, buttes, and mesas by the Colorado River, Green River, and their tributaries, which divide the park into three districts. There are rock pinnacles and other naturally sculpted rock, as well as artifacts from Ancient Pueblo Peoples.', 																		'park_date' => 'September 12, 1964', 	'park_area' => '337,597'],
		['park_name' => 'Capitol Reef', 		'park_location' => 'Utah', 				'park_description' => 'The park\'s Waterpocket Fold is a 100-mile (160 km) monocline that shows the Earth\'s geologic layers. Other natural features are monoliths and sandstone domes and cliffs shaped like the United States Capitol.', 																																		'park_date' => 'December 18, 1971', 	'park_area' => '241,904'],
		['park_name' => 'Channel Islands', 		'park_location' => 'California', 		'park_description' => 'Five of the eight Channel Islands are protected, and half of the area of the park is underwater. The islands have a unique Mediterranean ecosystem. They are home to over 2,000 species of land plants and animals, and 145 are unique to them. The islands were originally settled by the Chumash people.', 											'park_date' => 'March 5, 1980', 		'park_area' => '249,561']
	];

	foreach ($national_parks as $parks) {
		$query = "INSERT INTO national_parks (name, location, description, date_established, area_in_acres) VALUES ('{$parks['park_name']}', '{$parks['park_location']}', '{$parks['park_description']}', '{$parks['park_date']}', '{$parks['park_area']}');";	
		$mysqli->query($query);
	}

	// Run query, if there are errors then display them
	if (!$mysqli->query($query)) {
		throw new Exception("Table creation failed: (" . $mysqli->errno . ") " . $mysqli->error);
	}

	// echo $mysqli->host_info . "\n";
?>	