<?php
include "header.php"; 

//om man har klickat på "logga ut" avslutas session
if(isset($_GET["loggedout"])) { 
	unset($_SESSION["logged_in"]);
} 

//om man försöker gå in på dashboard, new_post eller comments utan att vara inloggad 
if(isset($_GET["not_set"])){ 
	$not_set_msg = "<p class='error'>Du måste fylla i dina användaruppgifter!</p>";
} else {
	$not_set_msg = "";
}

//Om användare och lösenord inte finns
if(isset($_GET["unknown"])){ 
	$error_msg = "<p class='error'> Okänd användare, försök igen!</p>";
} else {
	$error_msg = "";
}

//Om man försöker gå in på index.php och man redan är inloggad skickas man till loggedin.php
if(isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == "TRUE") {
	header("Location: loggedin.php");
}
?>
	<div id="startpage">
		<?php	
			echo "<p> $error_msg </p>"; //meddelande visas - okänd användare
			echo "<p> $not_set_msg </p>"; //meddelande visas - ej ifyllda uppgifter
		?>
		
		<h3>Välkommen!</h3>
		<p>PinYourPlace är en tjänst för att spara platser som man har besökt och som man vill minnas för sig själv och tipsa andra om. På så sätt hittar du alltid tips på bra restauranger, trevliga hotell, nya shoppingplatser och roliga nöjen.</p>
	

		<h3>Logga in</h3>	
		<!--Formulär där användaren kan logga in-->
		<form class="form" method="post" action="checkuser.php">
			<label>Användarnamn:</label> <br/> <input class="cell" type="text" name="username"/><br/>
			<label>Lösenord:</label> <br/> <input class="cell" type="password" name="password"/><br/>
			<input class='button' type="submit" name="login" value="Logga in"/><br/>
		</form> <!-- #FORM -->

		<p>Inget konto?</p>
		<a href="new_user.php"><input class='button' type="submit" name="register" value="Registrera dig här"/></a>
	</div>
	
<?php include "footer.php"; ?>
	
	

