<?php
	session_start(); //startar session

	include "db_connect.php"; //anslutning till databasen

	if(empty($_POST["username"]) || empty($_POST["password"])) { //om man försöker logga in med tomt login-formulär
		header("Location: index.php?not_set");
	} else if(isset($_POST["username"]) && isset($_POST["password"])) { //om man har fyllt i login-formuläret 
		$username = $_POST["username"];
		$password = $_POST["password"];

		$query = "SELECT * FROM user WHERE username = '$username' AND password = '$password'"; //Fråga databasen efter användarnamn och lösenord

		$result = mysqli_query($dbc, $query) 
		or die("Error querying database.");

		if (mysqli_num_rows($result) == 1) { //Kollar om det finns någon användare med det användarnamnet.
			$_SESSION["logged_in"] = TRUE; //Finns användaren sätts sessionsvariabeln logged_in till TRUE
			
			while($row = mysqli_fetch_array($result)) { 
				$_SESSION["user_id"] = $row["id_user"];
				$_SESSION["firstname"] = $row["fname"];
				$_SESSION["lastname"] = $row["lname"];				
			}
			
			$result = mysqli_query($dbc, $query); //stämmer allt skickas man vidare som inloggad till dashboard.php
			header("Location: loggedin.php");
			
		} else {
			header("Location: index.php?unknown"); //stämmer de inte visas ett felmeddelande och en är fortfarande kvar på index.php
		}
	}
?>