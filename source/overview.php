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
			$manager = new CDManager;
			$manager->read_all();
		?>	</body>
</html>