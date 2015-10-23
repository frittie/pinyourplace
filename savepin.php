<?php 
	include "db_connect.php";

		if(empty($_POST["title"]) || empty($_POST["address"]) || empty($_POST["description"]) || empty($_POST["category"])) { //om någon input ej är ifylld
			header("Location: loggedin.php?empty") ;
		} else {
			$lng = $_POST["lng"];
			$lat = $_POST["lat"]; 
		    $title = $_POST["title"];
			$address = $_POST["address"];
			$description = $_POST["description"];
			$category = $_POST["category"];
			
			$result = mysqli_query($dbc, $query = "INSERT INTO pin (lng, lat, title, address, description, id_user, id_category) VALUES ('$lng','$lat', '$title', '$address','$description', '', '$category')");

			if($result) {
				echo "success";
			} else {
				echo "fail";
			}
		}//Stänger den första if satsen
?>