<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
 <head>
         <title>CD Shop</title>
         <meta name="description" content="Projekt CD Shop für das Modul Web programming (BTI7054)">
         <meta name="author" content="bergs13">
         <link rel="stylesheet" href="styles/design.css" type="text/css">
 </head>
 <body>
         <div id="site">
                 <div id="header">
                         <img src="resources/header.png" alt="error loading resources/header.png" border="0" usemap="#navigation">
                         <map name="navigation">
                                 <area shape="rectangle" coords="222,115,345,132" href="index.php?page=overview" alt="&Uuml;bersicht" title="&Uuml;bersicht">
                                 <area shape="rectangle" coords="392,115,516,132" href="index.php?page=cdeditor" alt="CD-Editor" title="CD-Editor">
                                 <!--<area shape="rectangle" coords="564,115,686,132" href="index.php?page=thirdpage" alt="Dritte Seite" title="Dritte Seite">-->
                         </map>
                 </div>
                 <div id="main">
                         <div id="left">
                                 <img src="resources/left.png" alt="error loading resources/left.png">
                         </div>
                         <div id="center">
                                 <?php										 $page = "";										 if(isset($_GET['page']))										 {
											$page = $_GET['page'];										 }
                                         $pages = array('overview', 'cdeditor');
                                         if (!empty($page))
                                         {
                                                 if(in_array($page,$pages))
                                                 {
                                                         $page = dirname(__FILE__) . '/' . $page . '.php';
                                                         include($page);
                                                 }
                                                 else
                                                 {
                                                         echo 'Seite nicht gefunden. Zurück zur <a href="index.php">Startseite</a>';
                                                 }
                                         }
                                         else
                                         {
                                                 //default page
                                                 include(dirname(__FILE__) . '/overview.php');
                                         }
                                 ?>
                         </div>
                         <div id="right">
                                 <img src="resources/right.png" alt="error loading resources/right.png">
                         </div>
                 </div>
                 <div id="footer">
                         &copy; Copyright 2013 Stefan Berger
                 </div>
          </div>
 </body>
</html>