<?php 
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "store_items";

//Get Connection//
$conn = mysqli_connect($servername, $username, $password, $dbname);
if(!$conn)
{
	die("Connection failed: " . mysqli_connect_error());
}

//Delete Unwanted Items From Shopping Cart//
if(isset($_GET["action"])){
	if($_GET["action"] == "delete")
	{
		foreach($_SESSION["shopping_cart"] as $keys => $values){
			if($values["item_id"] == $_GET["id"])
			{
				unset($_SESSION["shopping_cart"][$keys]);
			}
		}
	}
}

//Send Checkout Information To Database(s)//
if(isset($_POST['submit'])){
	if(!empty($_POST['firstname']) &&!empty($_POST['lastname']) && !empty($_POST['email']) && !empty($_POST['phone']) && !empty($_POST['Address'])&&!empty($_POST['suburb'])&& !empty($_POST['postcode'])&& !empty($_POST['state']) &&!empty($_POST['message'])&& !empty($_POST['payconfirm'])&& !empty($_POST['total'])){
		
		$firstname= $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
		$address= $_POST['Address'];
        $message = $_POST['message'];
		$paymentconfirm = $_POST['payconfirm'];
        $total = $_POST['total'];
		$suburb=
		$_POST['suburb'];
		$postcode = $_POST['postcode'];
        $state = $_POST['state'];
		
		$query = "INSERT INTO checkout_data(total, firstname, lastname, email, phone, address, suburb, postcode, state, payment_confirm, message) VALUES('$total', '$firstname', '$lastname', '$email', '$phone',
		'$address', '$suburb', '$postcode', '$state','$paymentconfirm', '$message')";
		
		
		$run = mysqli_query($conn, $query) or die (mysqli_error($conn));
		$last_id = mysqli_insert_id($conn);
		
		for ($i = 0; $i < count($_POST['name']); $i++)
		{
			$query = "INSERT INTO checkout_items(itemname, price, quantity, order_id) VALUES('" . $_POST['name'][$i] . "', '" . $_POST['price'][$i] . "', '" . $_POST['quantity'][$i] . "', $last_id)";


			$run = mysqli_query($conn, $query) or die (mysqli_error( $conn));
		}
		
		//Checking if submission was successful//
		if($run){
			?>
			<div>
	            <center>
		            <a class="Checkout_Page_Confirmation" href="Checkout Page.php">Checkout Successful</a>
	            </center>
            </div>
            <?php 
		}
		else{
			?>
			<div>
	            <center>
		            <a class="Checkout_Page_Confirmation" href="Checkout Page.php">Checkout Unsuccessful</a>
	            </center>
            </div>
            <?php
		}
	}
    else{
		?>
        <div>
	        <center>
		        <a class="Checkout_Page_Confirmation" href="Checkout Page.php">All Fields Required</a>
	        </center>
        </div>
        <?php
	}
}


?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Item Checkout</title>
<title>Serenity Clinic</title>
<link rel="stylesheet" href="Styling The Website.css" >
<link rel="icon" type="image/x-icon" href="/Images/company logo.jpg">
	
<!-- Font For Website -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@500&display=swap" rel="stylesheet">

<!-- Picture & Title For Header -->
<section class="Title">
	<a href="The Home Page.html"><img src="Images/company logo.jpg" alt=" " width="130" length="130" loading="lazy">	</a>
</section>
<br>
<h1 class="Title-Name"> Serenity Clinic </h1>
<br>
<!-- Sub Menu For Different Pages In Header -->
<header class="Sub-Menu">
	<div>
    	<nav> 
	       <ul>
		       <li>
		           <a href="The Home Page.html">
		           Home</a> 
	           </li>
	           <li>
		           <a href="Biography Page.html">Bio</a>
	           </li>
	           <li>
	        	   <a href="Who I Work With Page.html"> Who I Work With</a>
	           </li>
	           <li>
		           <a href="How I Work Page.html"> How I Work
		           </a>
	           </li>
    	       <li>
	        	   <a href="Services Page.html">  Services </a>
	           </li>
	           <li>
		           <a href="Make An Appointment Page.html"> Make An Appointment </a>
	           </li>
	           <li>
		           <a href="Testimonials Page.html"> Testimonials </a>
	           </li>
	           <li>
		           <a href="Contact Page.html"> Contact </a>
	           </li>
	           <li>
		           <a href="Store Page.html"> Store </a>
	           </li>
			   <li>
		           <a href="Checkout Page.php"> Checkout Page </a>
	           </li>	
	       </ul>
       </nav>
	</div>
</header>
</head>

<body>
	
<!--Three Lines of Code From Tutorial, Don't Understand What They Actually Do-->
<br/>	
<div style="clear:both"></div>
<br/>
	
	
<!--Shopping Cart Section of The Checkout Page-->
<form class="Form-Style-Appointment" action="Checkout Page.php" method="post">	
<div>
	<table class="table_style">
	    <tr>			
		    <th>Item Name</th>
		    <th>Quantity</th>
		    <th>Price</th>
		    <th>Total</th>
		    <th>Action</th>
	    </tr>
		
		<!--Adding Information To Shopping Cart-->
	    <?php	
		if(!empty($_SESSION["shopping_cart"]))
        {
		    $total = 0;	
			foreach($_SESSION["shopping_cart"] as $keys => $values)
			{
		?>	

				<tr class="table_style-1">
					<td><?php echo $values["item_name"]; ?><input type="hidden" name="name[]" value="<?= $values["item_name"]; ?>"></td>
					<td><?php echo $values["item_quantity"]; ?><input type="hidden" name="quantity[]" value="<?= $values["item_quantity"]; ?>"></td>
					<td>$ <?php echo $values["item_price"]; ?><input type="hidden" name="price[]" value="<?= $values["item_price"]; ?>"></td>
					<td>$ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2) ?></td>
					<td><a href="Checkout Page.php?action=delete&id=<?php echo $values["item_id"];?>"><span class="price_of_item">Remove</span></a></td>
				</tr>
		<?php
					$total = $total + ($values["item_quantity"] * $values["item_price"]);
	    	}
	    ?>
	    <tr>
	    	<td>Total</td>
		    <center>
				<td>$ <?php echo number_format($total, 2);?></td>	
			</center>
    	</tr>
		<?php

		}
		?>		
	</table>
	<br>
	<br>
	<!-- Buttons For The Other Sections Of The Website -->
	<!-- Extra Form There As A Form To Make The Others Work By Not Being The First Form -->
	<form method="get" action="Oils.php">
	</form>
	<center>
		<form method="get" action="Oils.php">
	        <button>Oils Catalogue</button>
        </form>
    </center>
	<br>
	<center>
	    <form method="get" action="Meditation Balls.php">
	        <button>Meditation Balls Catalogue</button>
        </form>
	</center>
	<br>	
	<center><legend>Checkout Section</legend></center>
	<!--Checkout Page Of Website-->
	<div class="Form-Style-Appointment-2">
		<!--Regular Info Section-->
		<div>	
			<br>
   	        <input class="Form-Style-Appointment-1" type="text" name="firstname" placeholder="First Name" required>
            <br>
            <input class="Form-Style-Appointment-1" type="text" name="lastname" placeholder="Last Name" required>
            <br>
            <input class="Form-Style-Appointment-1" type="text" name="email" placeholder="Email" required>
            <br>
	        <input type="tel" name="phone" id="Phone" placeholder="Phone Number" autocomplete="on" maxlength="10" minlength="10" required>
	        <br>
		</div>
	</div>
	<hr>	
	<!--Address Info Section-->
	<br>
	<input class="Form-Style-Appointment-2" type="text" name="Address" placeholder="Street Address" required>
	<br>
	<input class="Form-Style-Appointment-2" type="text" name="suburb" placeholder="Suburb" required>
	<br>
	<input type="text" name="postcode" placeholder="Postcode" required>
	<br>
	<label>State Of Residence</label>
	<select name="state" id="state" required> 
		<option>ACT</option>
		<option>NSW</option>
		<option>NT</option>
		<option>QLD</option>
		<option>SA</option>
		<option>TAS</option>
		<option>VIC</option>
		<option>WA</option>
	</select>
	<br>
	<br>
	<!--Credit Card Details Of The User-->
	<hr>
	<br>
    <input type="tel" name="Card Number" id="Card Number" placeholder="Card Number" maxlength="16" minlength="16" autocomplete="on" required>
    <br>
	<label>Expiry Date</label>
	<select name="Month" id="Month" required> 
		<option>01</option>
		<option>02</option>
		<option>03</option>
		<option>04</option>
		<option>05</option>
		<option>06</option>
		<option>07</option>
		<option>08</option>
		<option>09</option>
		<option>10</option>
		<option>11</option>
		<option>12</option>
	</select>
	<select name="Year" id="Year" required>
		<option>2022</option>
		<option>2023</option>
		<option>2024</option>
		<option>2025</option>
		<option>2026</option>
		<option>2027</option>
		<option>2028</option>
		<option>2029</option>
		<option>2030</option>
	</select>
	<br>
	<br>
	<input type="text" name="CCV" id="CCV" placeholder="CCV Code" autocomplete="on" minlength="3" maxlength="3" required>
	<br>
    <textarea name="message" placeholder="Message" maxlength="100%" required></textarea>
	<br>
	<input type="hidden" name="payconfirm" value="success">
	<input type="hidden" name="total" value="<?= $total; ?>">
    <center>
		<button type="submit" name="submit">CHECKOUT</button>
	</center>
</form>
</body>
	
<footer class="Footer-Style">
<!-- Footer Of Website -->
	<br>
	<center>
		<p>0413226055</p>
	</center>
	<div class="Footer-Style-Buttons">
		<a href="https://www.facebook.com/"><img src="Images/footer-facebook.png" alt="" width="20px" length="20px"></a>
		<a href="https://twitter.com/?lang=en"><img src="Images/Footer-Twitter.jpg" alt="" width="20px" length="20px"></a>
		<a href="https://au.linkedin.com/"><img src="Images/footer-linkedin.png" alt="" width="20px" length="20px"></a>
		<a href="The Home Page.html"><img src="Images/footer-paperclip.jpg" alt="" width="20px" length="20px"></a>
	</div>
</footer>
</html>