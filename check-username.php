<?php
	include "db_connect.php"; //anslutning till databasen

	$username = $_POST["name"];

	$stmt = $dbc->stmt_init();

	$query = "SELECT * FROM user WHERE username = '$username'";
	$result = $dbc->query($query);
	$stmt->prepare($query);

	$result = mysqli_query($dbc, $query) 
		or die("Error querying database.");

	if (mysqli_num_rows($result) > 0) { //Kollar om det finns någon användare med det användarnamnet.
		echo "fail"; 	
	}else {
		echo "success";
	}

?>