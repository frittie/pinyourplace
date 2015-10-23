var markers = [];

window.history.forward();

$(document).ready(function() {
	var infowindow;

	//Centrerar kartan beroende på vart man är 
    navigator.geolocation.getCurrentPosition(function(position) {
      initialLocation = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
      map.setCenter(initialLocation);
    });
  	
	//Betsämmer vilken del av kartan man ska se.
	var mapOptions = {
		center: {lat: 59.346027, lng: 18.058272},
		zoom: 14,
		scrollwheel: false,
	};

	//Styling kartan
	var mapStyle = [{
		featureType: 'all',
		elementType: 'geometry',
		stylers: [
			{ lightness: 20 },
			{ saturation: 100 }, //-100 är svartvitt
			{ gamma: 0.76 },
			{ visibility: 'on' }
		]
	}];

	//Skapar kartan
	var map = new google.maps.Map( 
		document.getElementById('map'), //bestämmer vart i html-dokumentet kartan ska visas
		mapOptions
	);

	//Anropar styling för kartan
	map.setOptions({styles: mapStyle}); 

	google.maps.event.addListener(map, 'click', function(e){
		var lat = e.latLng.A;
		var lng = e.latLng.F;
		
		//marker.setPosition(new google.maps.LatLng(lat, lng));
		$("#info").fadeIn();
		$('#lng').val(lng);
		$('#lat').val(lat);
	});

	//Gör en ajax call till getpin.php och tar resultatet från getpin.php och gör en markör för varje json object
	$.get("getpin.php", function(data){
		data = JSON.parse(data);
		for(var i = 0; i < data.length; i++){

			//Skapar en array där vi hämtar ut alla ikoner
			var images = ["img/cutlery.png", "img/bed.png", "img/cart.png", "img/glass.png" ];

			//Hämtar ut alla pins från databasen och kopplar ihop dem med rätt ikon, title, address och description
			var marker = new google.maps.Marker({
		    	map: map,
		    	position: new google.maps.LatLng(data[i].lat, data[i].lng),
		    	title: data[i].title,
			    content: '<div id="pinInfo"><h2>' + data[i].title + '</h2><p>Adress: ' + data[i].address + '</p><p>Beskrivning: ' + data[i].description + '</p>',
				animation: google.maps.Animation.DROP,
				icon: images[data[i].id_category - 1],
				category: data[i].id_category
		    });
		    
		    markers.push(marker);

		    google.maps.event.addListener(marker, 'click', function(){ //när man klickar på platsen syns en text
		    	infowindow.setContent(this.content);
				infowindow.open(map, this);
			});
		}
		
		var infowindow = new google.maps.InfoWindow({
	    	content: ""
	    });

		//Sorterar pins beoende på vilken kategori man har klickat på 
    	$(".menu ul li").on("click", function(){
    		var className = $(this).attr('class');
    		for (var i = 0; i < markers.length; i++) {
    			if(className == "all") {
    				markers[i].setMap(map);
    			}
    			else if(markers[i].category == className) {
    				markers[i].setMap(map);
    			} else {
    				markers[i].setMap(null);
    			}
    		};
		});
	});

	//När man har klickat på submit-knappen sparas värdet i input-fälten i variabler
	$("#submitInfo").on('click', function(){
		var lng = $('#lng').val();
		var lat = $('#lat').val();
		var title = $('#pintitle').val();
		var address = $('#address').val();
		var description = $('#description').val();
		var category = $('#selectCategory option:selected').val();
		
		$.post( "savepin.php", {
			'lng': lng,
			'lat': lat,
			'title': title,
			'address': address,
			'description': description,
			'category': category
		}, function( data ) {
			if (data == 'success') {
				$("#info").fadeOut();
				document.getElementById("createPin").reset(); //Tömmer formuläret
				
				var images = ["img/cutlery.png", "img/bed.png", "img/cart.png", "img/glass.png" ]; //Array med pin ikoner
			    var marker = new google.maps.Marker({
			    	map: map,
			    	position: new google.maps.LatLng(lat, lng),
			    	title: title,
					animation: google.maps.Animation.DROP,
					icon: images[category - 1],
					content: contentString,
					category: category
			    });

			    markers.push(marker);

			    var contentString = '<div id="pinInfo"><h2>' + title + '</h2><p>Adress: ' + address + '</p><p>Beskrivning: ' + description + '</p>';

			    var infowindow = new google.maps.InfoWindow({
			    	content: contentString
			    });

			    google.maps.event.addListener(marker, 'click', function(){ //när man klickar på platsen syns en text
					infowindow.open(map, marker);
				}); 
		    	
			} else {
				console.log("error");
			}
		});
	});
});






