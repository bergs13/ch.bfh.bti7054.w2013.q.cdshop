<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>CD-�bersicht</title>
		<meta name="description" content="CD-�bersicht zum st�bern">
		<meta name="author" content="bergs13">
		<link rel="stylesheet" href="styles/page.css" type="text/css">
	</head>
	<body>
		<h1>�bersicht</h1>
		<?php
			$a = array	(
							1 => array("Metallica", "Master of puppets", 1986),
							2 => array("Slayer","Reign in blood", 1986)
						);
			foreach($a as $key => $value)
			{
				echo "$key:<br/>";
				echo "$value[0]<br/>";
				echo "$value[1]<br/>";
				echo "$value[2]<br/><br/>";
			}
			
		?>	</body>
</html>