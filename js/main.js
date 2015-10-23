$(document).ready(function() {

	$("#registrate #username").blur(function(e){
		if($("#username").val().length == 1){
			 $("#feedback").html("");
		}

		$.post("check-username.php", {name: $("#username").val()}).done(function(data){
			console.log(data);
			if(data == "success") {
				$("#feedback").html("");
			}else {
				$("#feedback").html("Användarnamnet är upptaget");
			}
		});		
	});

	$('.mobile_menu .fa-bars').on('click', function(){
		$('#menu_content').slideToggle('slow');
	});
	$('.mobile_menu ul li').on('click', function(){
		$('#menu_content').slideToggle('slow');
	});

	$('.info').on('click', function() {
		$('.info_text').slideToggle('slow');
	});

	$('.fa-times').on('click', function(){
		$('.info_text').slideToggle('slow');
	});

	$('#cancel').on('click', function(){
		$("#info").slideToggle('slow');
	});
});
