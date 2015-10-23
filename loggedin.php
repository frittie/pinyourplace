<?php 
include "header.php"; 

if(isset($_POST["login"])){
	$_SESSION["logged_in"] = "TRUE"; 

} else if(isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == "TRUE") {
	// redan inloggad, allt ok

} else {
	// Om man försöker komma åt sidan utan att vara inloggad skickas man till index.php
	$_SESSION["logged_in"] = "FALSE";
	header("Location: index.php?not_set");
}

//om man inte fyller i alla fält när man skapar ny pin
if(isset($_GET["empty"])){  
	$empty = "<p class='error'>Du måste fylla i alla fält</p>";
} else {
	$empty = "";
}
?>
	<script 
	type="text/javascript" 
	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBGIgmodIPp6-FkD_YsPkwR8V3_VqCi4Ac">
	</script>

	<div class="mobile_menu">
		<i class="fa fa-bars"></i>
		<div id="menu_content" class="menu">
			<ul>
				<li class="all"><i class="fa fa-globe"></i> Alla Pins</li>
				<li class="1"><i class="fa fa-cutlery"></i> Restauranger </li>
				<li class="2"><i class="fa fa-bed"></i> Hotell </li>
				<li class="3"><i class="fa fa-shopping-cart"></i> Affärer </li>
				<li class="4"><i class="fa fa-glass"></i> Nöjen </li>
				<li class="info"><i class="fa fa-info-circle"></i> Info </li>
				<li><a href="index.php?loggedout"><i class="fa fa-sign-out"></i>Logga ut </a></li>
			</ul>
		</div>
	</div>
	<div class="clearfix"></div>

	<div class="desktop_menu">
		<div id="menu_content_descktop" class="menu">
			<ul>
				<li class="all"><i class="fa fa-globe"></i> Alla </li>
				<li class="1"><i class="fa fa-cutlery"></i> Restauranger </li>
				<li class="2"><i class="fa fa-bed"></i> Hotell </li>
				<li class="3"><i class="fa fa-shopping-cart"></i> Affärer </li>
				<li class="4"><i class="fa fa-glass"></i> Nöjen </li>
				<li class="info"><i class="fa fa-info-circle"></i> Info </li>
				<li><a href="index.php?loggedout"><i class="fa fa-sign-out"></i>Logga ut </a></li>
			</ul>
		</div>
	</div>

	<div id="wrapper_info">
		<div class="info_text">
			<i class="fa fa-times"></i>
			<h2>Info</h2>
			<p>PinYourPlace är en tjänst för att spara platser som man har besökt och som man vill minnas för sig själv och tipsa andra om. På så sätt har du alltid ett tips på en bra restaurang, ett trevligt hotell, bra shoppingplatser och roliga nöjen. Det är inte svårare än så, klicka på kartan där du har ett tips och börja pinna!</p>
		</div>
	</div>

	<div id="wrapper_map">
		<div id="content_map">
			<p>Klicka på kartan där du vill lägga till en ny pin!</p>
			<?php echo "<p> $empty </p>"; ?>
			<div id="info">
				<form class="form" id="createPin" method="post">
					<input type="text" id="lng" name="lng"/><br/>
					<input type="text" id="lat" name="lat"/><br/>
					<input type="text" id="pintitle" name="title" placeholder="Titel"/><br/>
					<input type="text" id="address" name="address" placeholder="Adress"/><br/>
					<textarea rows="4" cols="40" id="description" name="description" placeholder="Beskrivning"></textarea><br/>
					<select name="category" id="selectCategory">
						<option value="" selected disabled="">Välj kategori</option>
						<option value="1">&#xf0f5; Restaurang</option>
						<option value="2">&#xf236; Hotell </option>
						<option value="3">&#xf07a; Affärer </option>
						<option value="4">&#xf000; Nöjen</option>
					</select><br/>
					<input id="submitInfo" type="button" value="Lägg till Pin" name="addPin"/></br>
					<input id="cancel" type="button" value="Avbryt" name="cancel"/>
				</form>
			</div>
			<div id="map"></div>
		</div>
	</div>

	<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
	<script type="text/javascript"  src="js/googlemap.js"></script>	
	<script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/1.16.0/TweenMax.min.js"></script>
	<script src="js/main.js"></script>	
</body>
</html>



