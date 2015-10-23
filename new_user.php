<?php 
	include "header.php"; 
	
	//om man försöker gå in på loggedin.php inloggad 
	if(isset($_GET["not_set2"])){ 
		$not_set2_msg = "<p class='error'>Du måste fylla i alla fält!</p>";
	} else {
		$not_set2_msg = "";
	}

	echo "<p> $not_set2_msg </p>";

?>
<div id="wrapper_register">	
	<div id="registrate">
		<h2>Registrera dig här </h2>
		<form class="form" method="post" action="">
			<input type="text" id="contact_name" name="fname" placeholder="Förnamn"/><br/>
			<input type="text" id="contact_lname" name="lname" placeholder="Efternamn"/><br/>
			<input type="email" id="contact_email" name="email" placeholder="Email"/><br/>
			<span id="feedback"></span><br/>
			<input type="text" id="username" name="username" placeholder="Användarnamn"/><br/>
			<input type="password" id="password" name="password" placeholder="Lösenord"/><br/>
			<input type="submit" value="Registrera dig!" name="reg" id="reg-btn">
		</form>
		<a href="index.php"><p><i class="fa fa-arrow-left"></i>Tillbaka till startsidan</p></a>
	</div>
</div>

	<?php
		include "db_connect.php";

		if(isset($_POST["reg"])){
			if(empty($_POST["fname"]) || empty($_POST["lname"]) || empty($_POST["email"]) || empty($_POST["username"]) || empty($_POST["password"])) { //om man inte har fyllt i alla rutor i formuläret
			header("Location: new_user.php?not_set2");

			} else if(isset($_POST["reg"])) { //om man har klickat på "registrera" 
			    $fname = $_POST["fname"];
			    $lname = $_POST["lname"];
				$email = $_POST["email"];
				$username = $_POST["username"];
				$password = $_POST["password"];
				//regex som kontrollerar att e-mail är ifyllt på rätt sätt
				$regex = "/[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+/"; 

				if(preg_match( $regex, $email )!=0) {
					mysqli_query($dbc, $query = "INSERT INTO user (fname, lname, email, username, password ) VALUES ('$fname', '$lname','$email', '$username', '$password')");
					
					$_SESSION["logged_in"] = "TRUE";
					header("Location: loggedin.php");

				} else {
					echo "Kontrollera att din emailadress är rätt";	
				}
			} 
		}//Stänger den första if satsen
	?>

<?php include "footer.php"; ?>


