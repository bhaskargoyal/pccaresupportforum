<?php 

	$con = mysqli_connect("localhost", "root", "", "forum");
	if (!$con)
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

?>