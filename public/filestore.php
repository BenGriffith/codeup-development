<?php
	class Filestore {

		// Setting a public property
		public $filename = '';

		// Setting a private property
		private $is_csv = FALSE;

		// Sets the filename and checks to see the file is in a csv format
		public function __construct($filename = '')
		{
			$this->filename = $filename;
			if (substr($filename, -3) == 'csv') {
				$this->is_csv = TRUE;
			}
		}

		// If is_csv is true read a csv file else read a txt file
		public function read() 
		{
			if ($this->is_csv == TRUE) {
				return $this->read_csv();
			} else {
				return $this->read_lines();
			}
		}

		// If is_csv is true write a csv file else write a txt file
		public function write($array) 
		{
			if ($this->is_csv == TRUE) {
				return $this->write_csv($array);
			} else {
				return $this->write_lines($array);
			}
		}

		// Returns array of lines in $this->filename
		private function read_lines()
		{
			$handle = fopen($this->filename, 'r');
			$contents = fread($handle, filesize($this->filename));
			$contents_array = explode("\n", $contents);
			fclose($handle);
			return $contents_array;
		}

		// Writes each element in $array to a new line in $this->filename
		private function write_lines($array)
		{
			$handle = fopen($this->filename, 'w');
			$contents = implode("\n", $array);
			fwrite($handle, $contents);
			fclose($handle);
		}

		// Reads contents of csv $this->filename, returns an array
		private function read_csv()
		{
			$contents = [];
			$handle = fopen($this->filename, 'r');
			while(($data = fgetcsv($handle)) !== FALSE) {
		  		$contents[] = $data;
			}
			fclose($handle);
			return $contents;
		}

		// Writes contents of $array to csv $this->filename
		private function write_csv($array)
		{
			$handle = fopen($this->filename, 'w');
			foreach ($array as $fields) {
			    fputcsv($handle, $fields); 
			}
			fclose($handle);
		}
	}
?>