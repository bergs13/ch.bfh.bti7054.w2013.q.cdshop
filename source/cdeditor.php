<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>CD-�bersicht</title>
		<meta name="description" content="CD-�bersicht zum st�bern">
		<meta name="author" content="bergs13">
		<link rel="stylesheet" href="styles/page.css" type="text/css">
	</head>
	<body>
		<?php	
		//translations
			$editor;
			$languagemanager = new LanguageManager;
			if($languagemanager->language == "DE")
			{
				$editor = "CD-Editor";
			}
			else if($languagemanager->language == "EN")
			{
				$editor = "CD-Editor";
			}
			
			//output
			echo "<h1>$editor</h1>";
			$cdmanager = new CDManager($languagemanager);
			$cdmanager->handle_post();
		?>	</body>
</html>