<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>About</title>
		<meta name="description" content="Infos über den CD-Shop">
		<meta name="author" content="bergs13">
		<link rel="stylesheet" href="styles/page.css" type="text/css">
		<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDmLQ7T-fWHRisGsqZcuEpi55TECdSSZgQ&sensor=false"></script>
		<script type="text/javascript">
			function initialize() {
				var latLng = new google.maps.LatLng(46.964615,7.456132);
				
				var mapOptions = {
				  center: latLng,
				  zoom: 16
				};
				
				var map = new google.maps.Map(document.getElementById("tehcdshopmap"), mapOptions);

				var marker = new google.maps.Marker({
					position: latLng,
					title:"Hello World!"
				});
				marker.setMap(map);
			}
			google.maps.event.addDomListener(window, 'load', initialize);
		</script>
	</head>
	<body>
		<?php
			$about;
			$adress;
			$languagemanager = new LanguageManager;
			if($languagemanager->language == "DE")
			{
				$about = "Über";
				$adress = "Adresse";
			}
			else /*if($languagemanager->language == "EN")*/
			{
				$about = "About";
				$adress = "Adress";
			}
			echo "<h1>$about</h1>";
			echo "<p>";
			echo "$adress:<br/>";
			echo "Teh cdshop<br/>";
			echo "Wankdorffeldstrasse 102<br/>";
			echo "3000 Bern";
			echo "</p>";
		?>
		<!--Google maps containter-->
		<div id="tehcdshopmap"></div>
	</body>
</html>