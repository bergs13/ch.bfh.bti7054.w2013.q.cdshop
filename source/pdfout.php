<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>PDF Output</title>
		<meta name="description" content="PDF Output page for FPDF">
		<meta name="author" content="bergs13">
		<link rel="stylesheet" href="styles/page.css" type="text/css">
	</head>
	<body>
		<?php
			if(isset($_POST["fpdfstring"]))
			{
				require_once("logic/php/PDFWriter.php");
				$fpdfstring = $_POST["fpdfstring"];
				$pdfwriter = new PDFWriter('L','mm','A4');
				$linearray = explode("\n", $fpdfstring);
				foreach( $linearray as $line )
				{
					$pdfwriter->write_line($line);
				}
				$pdfwriter->save();
			}
		?>
	</body>
</html>