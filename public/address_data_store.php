<?php

	require('filestore.php');

	// Declaring a class named AddressDataStore
	class AddressDataStore extends Filestore {

		function __construct($filename = '') 
		{
			$filename = strtolower($filename);
			parent::__construct($filename);
		}
	}
?>