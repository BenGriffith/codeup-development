<?php

	// Requiring filestore.php to be apart of the program before it continues
	require('filestore.php');

	// Invalid input exception
	class InputException extends Exception {}

	// Creating a new object of the Filestore class and passing through 'data/todo_list.txt'
	$todoFilestore = new Filestore('data/todo_list.txt');

	// If the filesize is greater than zero
	if (filesize($todoFilestore->filename) > 0) {
		// Read file, convert it to array, and set it equal to $items
		$items = $todoFilestore->read();
	} else {
		// Else set $items equal to an empty array
		$items = array();
	}

	try {
			// If the task field is set and empty print an exception error to the screen
			if (isset($_POST['newitem']) && empty($_POST['newitem'])) {
				throw new InputException("A task was not entered. Please enter a task.");
			}

			// If the task field is set and the string length is greater than 240 characters print an exception error to the screen
			if (isset($_POST['newitem']) && strlen($_POST['newitem']) > 240) {
				throw new InputException("Too many characters. Please enter a task less than 240 characters.");
			}	
				
			// If 'newitem' is set and 'newitem' is not empty
			if (isset($_POST['newitem']) && !empty($_POST['newitem'])) {
				$new_item = $_POST['newitem'];
				array_push($items, $new_item);
				$todoFilestore->write($items);		
				header('Location: todo-list.php');
				exit(0);
			}
		} catch (InputException $e) {
			echo $e->getMessage();
		}	


	// Remove an item from the todo list by clicking on link
	if (isset($_GET['remove'])) {
		$key = $_GET['remove'];
		unset($items[$key]);
		$todoFilestore->write($items);
		header('Location: todo-list.php');
		exit(0);
	}

	// Verify there were uploaded files and no errors and the file being uploaded is in text format
	if (count($_FILES) > 0 && $_FILES['file1']['error'] == 0 && $_FILES['file1']['type'] == 'text/plain') {
		// Set the destination directory for uploads
		$upload_dir = '/vagrant/sites/codeup.dev/public/uploads/';
		// Grab the filename from the uploaded file by using basename
		$file_name = basename($_FILES['file1']['name']);
		// Create the saved filename using upload directory and the file's original name
		$saved_filename = $upload_dir . $file_name;
		// Move the file from the temp location to our uploads directory
		move_uploaded_file($_FILES['file1']['tmp_name'], $saved_filename);
		
		$todoFilestore->filename = $saved_filename;

		$uploaded_items = $todoFilestore->read();

		$todoFilestore->filename = 'data/todo_list.txt';
		// Merge converted uploaded file to existing array of todos
		$other_items = array_merge($items, $uploaded_items);
		$todoFilestore->write($other_items);
		header('Location: todo-list.php');
		exit(0);
	} elseif (count($_FILES) > 0 && $_FILES['file1']['type'] != 'text/plain') {
		echo "<strong>ERROR! File format is invalid! Please upload a txt file.</strong>";	
	}

?> 

<!DOCTYPE html>
<html>
	<head>
		<title>Ben's To Do List</title>
		<link rel="stylesheet" href="/css/todo.css">
	</head>
	<body>
		<h2>To Do List</h2>
		<ul>
			<?php
				foreach ($items as $key => $value) {
					echo "<li>{$value}  <a href='?remove={$key}'>Mark Complete</a></li>";
				}
			?>
		</ul>

		<h2>Add an Item to the To Do List</h2>
			<form method="POST" action="/todo-list.php">
				<p>
					<label for="newitem">Task: </label>
					<input type="text" id="newitem" name="newitem" placeholder="Enter Task Item">
				</p>
				<button type="submit">Submit</button>
			</form>
		
		<h2>Upload File</h2>
			<form method="POST" enctype="multipart/form-data" action="/todo-list.php">
				<p>
					<label for="file1">File to upload: </label>	
					<input type="file" id="file1" name="file1">
				</p>
				<p>
					<input type="submit" value="Upload">
				</p>
			</form>

	</body>
</html>