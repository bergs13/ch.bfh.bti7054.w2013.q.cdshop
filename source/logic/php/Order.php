<?php
	class Order
	{
		private $language;
		private $producthtml;
		private $paymentmethods;
		public function __construct($language)
		{			
			$this->language = $language;
			$descriptionmanager = new DescriptionDataManager;
			$this->paymentmethods = $descriptionmanager->get_paymentmethods();
			$this->shippingmethods = $descriptionmanager->get_shippingmethods();
		}
		public function set_producthtml($producthtml)
		{
			$this->producthtml = $producthtml;
		}
		public function display_checkout()
		{	
			//manage language texts
			$products;
			$customization;
			$paymentmethodlabel;
			$shippingmethodlabel;
			$recipient;
			$submit;
			$firstname;
			$lastname;
			$adresslabel;
			$sendorder;
			$email;
			if($this->language == "DE")
			{
				$products = "Artikel";
				$customization = "Bestelloptionen";
				$paymentmethodlabel = "Zahlungsmethode";
				$shippingmethodlabel = "Versandmethode";
				$recipient = "Bestellempfänger";
				$submit = "Bestellung übermitteln";
				$firstname = "Vorname";
				$lastname = "Name";
				$adresslabel = "Adresse";
				$sendorder = "Wollen Sie ihre Bestellung wirklich übermitteln?";
				$email = "Email";
			}
			else if($this->language = "EN")
			{
				$products = "Products";
				$customization = "Order options";
				$paymentmethodlabel = "Payment method";
				$shippingmethodlabel = "Shipping method";
				$recipient = "Order recipient";
				$submit = "Submit order";
				$firstname = "Firstname";
				$lastname = "Lastname";
				$adresslabel = "Adress";
				$sendorder = "Do you really want to submit your order?";
				$email = "Email";
			}
			//top submit
			echo "<form action=\"index.php?page=finish\" method=\"post\" 
						onSubmit=\"if(!confirm_order('$sendorder')){{return false;}}\">";
			echo "<p>";
			echo "<input type=\"submit\" value=\"$submit\">";
			echo "</p>";
			
			//user and address		
			echo "<p>";
			echo "<h2>$recipient</h2>";
			echo "<table><tr>";
			echo "<td>$lastname:</td><td><input name=\"lastname\"></input></td>";
			echo "<td valign=\"top\">$adresslabel:</td>
					<td valign=\"top\" rowspan=\"3\"><textarea name=\"adress\" cols=\"20\" rows=\"5\" width=\"100%\" max-width=\"100%\"></textarea></td>";
			echo "</tr>";
			echo "<tr><td>$firstname:</td><td><input name=\"firstname\"></input></td></tr>";
			echo "<tr><td>$email:</td><td><input name=\"email\"></input></td></tr>";
			echo "</table>";
			echo "</p>";
			
			//customization
			echo "<p>";
			echo "<h2>$customization</h2>";
			echo "<table>";
			//radios
			echo "<tr>";
			echo "<td valign=\"top\">$paymentmethodlabel:</td><td valign=\"top\">";
					$checked = "checked";
					while($paymentmethod = $this->paymentmethods->fetch_object())
					{
						echo "<input type=\"radio\" name=\"paymentmethod\" value=\"$paymentmethod->id\" $checked>$paymentmethod->name</input><br>";
						if($checked == "checked")
						{
							$checked = "";
						}
					}
					echo "<br>";
			echo "</td>";
			echo "<td width=\"50px\"></td>";
			echo "<td valign=\"top\">$shippingmethodlabel:</td><td valign=\"top\">";
					$checked = "checked";
					while($shippingmethod = $this->shippingmethods->fetch_object())
					{
						echo "<input type=\"radio\" name=\"shippingmethod\" value=\"$shippingmethod->id\" $checked>$shippingmethod->name</input><br>";
						if($checked == "checked")
						{
							$checked = "";
						}
					}
					echo "<br>";
			echo "</td></tr>";
			echo "</table>";
			echo "</p>";
			
			//products
			echo "<p>";
			echo "<h2>$products</h2>";
			if(isset($this->producthtml))
			{
				echo $this->producthtml;
			}
			echo "</p>";
			
			//bottom submit
			echo "<p>";
			echo "<input type=\"submit\" value=\"$submit\">";
			echo "</p>";
			echo "</form>";
		}
		public function handle_post()
		{
			//email and product html must be set!
			if(isset($_POST["email"]) 
				&& isset($this->producthtml))
			{
				//Collect data from the post
				$to = $_POST["email"];
				$lastname = "";
				if(isset($_POST["lastname"]))
				{
					$lastname = $_POST["lastname"];
				}
				$firstname = "";
				if(isset($_POST["firstname"]))
				{
					$firstname = $_POST["firstname"];
				}
				$adress = "";
				if(isset($_POST["adress"]))
				{
					$adress = $_POST["adress"];
				}
				$shippingmethodid = -1;
				if(isset($_POST["shippingmethod"]))
				{
					$shippingmethodid = $_POST["shippingmethod"];
				}
				$paymentmethodid = -1;
				if(isset($_POST["paymentmethod"]))
				{
					$paymentmethodid = $_POST["paymentmethod"];
				}
				
				//collect missing information
				$paymentmethodname = "";
				if($paymentmethodid > 0)
				{
					while($paymentmethod = $this->paymentmethods->fetch_object())
					{
						if($paymentmethod->id == $paymentmethodid)
						{
							$paymentmethodname = $paymentmethod->name;
						}
					}
				}
				$shippingmethodname = "";
				if($shippingmethodid > 0)
				{
					while($shippingmethod = $this->shippingmethods->fetch_object())
					{
						if($shippingmethod->id == $shippingmethodid)
						{
							$shippingmethodname = $shippingmethod->name;
						}
					}
				}
				
				//Set language texts
				$hello;
				$intro;
				$last;
				$first;
				$adresslabel;
				$paymentmethodlabel;
				$shippingmethodlabel;
				$products;
				$successreport;
				$subject;
				$getpdf;
				if($this->language == "DE")
				{
					$hello = "Dear customer";
					$intro = "Wir haben ihre Bestellung erhalten";
					$last = "Name";
					$first = "Vorname";	
					$adresslabel = "Adresse";
					$paymentmethodlabel = "Zahlungsmethode";
					$shippingmethodlabel = "Versandmethode";
					$products = "Produkte";
					$successreport = "Bestellung erfolgreich übermittelt. Eine Email wurde an Sie versendet.";
					$subject = "Bestellbestätigung von teh cdshop";
					$getpdf = "PDF anzeigen";
				}
				else if($this->language = "EN")
				{
					$hello = "Lieber Kunde";
					$intro = "We have received your order";
					$last = "Name";
					$first = "Firstname";
					$adresslabel = "Adress";
					$paymentmethodlabel = "Payment method";
					$shippingmethodlabel = "Shipping method";
					$products = "Products";
					$successreport = "Order successfully submitted. An email has been sent to you.";
					$subject = "Order confirmation from teh cdshop";
					$getpdf = "Show PDF";
				}
				
				//create the email text
				$text = "$hello/n/n";
				$text .= "$intro:/n";
				$text .= "$last: $lastname/n";
				$text .= "$first: $firstname/n";
				$text .= "$adresslabel:/n $adress/n";
				$text .= "$paymentmethodlabel: $paymentmethodname /n";
				$text .= "$shippingmethodlabel: $shippingmethodname /n/n";
				$text .= "$products: /n";
				//Product html from the shopping cart
				$plaintext = $text;
				$text .= "<html><head></head><body><p>";
				//products
				$text .= $this->producthtml;
				$text .= "</p></body></html>";
							
				//mails
				$header = "From: bergerstefan.88@gail.com\r\n";
				//customer
				mail($to, $subject, $text, $header);
				//shop
				mail('bergerstefan.88@gmx.ch', $subject, $text, $header);
				
				//success report
				echo $successreport."<br>"; 
				
				//button for generating pdf
				echo "<form action=\"pdfout.php\" method=\"post\">";
				echo "<input type=\"hidden\" name=\"fpdfstring\" value=\"$plaintext\">";
				echo "<input type=\"submit\" value=\"$getpdf\">";
				echo "</form>";
			}
		}
	}
?>