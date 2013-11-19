<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>Logout</title>
		<meta name="description" content="Maske für das Einloggen in den CD-Shop">
		<meta name="author" content="bergs13">
		<link rel="stylesheet" href="styles/page.css" type="text/css">
	</head>
	<body>
		<h1>Logout<h1>
		<?php
			$authenticator = new Authenticator;
			$authenticator->handle_logout();
		?>
		<!--redirect to index.php after logout-->
		<script type="text/javascript">
			window.location.href = "index.php";
		</script>
	</body>
</html>