<?php 
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "store_items";

//Connecting To Database//
$conn = mysqli_connect($servername, $username, $password, $dbname);
if(!$conn)
{
	die("Connection failed: " . mysqli_connect_error());
}

//Inserting The Book Now Information To The Database//
if(isset($_POST['submit'])){
	if(!empty($_POST['firstname']) &&!empty($_POST['lastname']) && !empty($_POST['email']) && !empty($_POST['phone']) && !empty($_POST['message'])){
		$firstname= $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $message = $_POST['message'];
		
		$query = "INSERT INTO book_now(firstname, lastname, email, phone, message) VALUES('$firstname', '$lastname', '$email', '$phone', '$message')";
		
		$run = mysqli_query($conn, $query) or die (mysqli_error($conn));
		
		//Potential Results Of Pressing The Book Now Button
		if($run){
			?>
            <div>
	            <center>
		            <a class="Checkout_Page_Confirmation" href="Book Now.php">Booking Successful</a>
	            </center>
            </div>
            <?php
		}
		else{
			?>
			<div>
	            <center>
		            <a class="Checkout_Page_Confirmation" href="Book Now.php">Booking Unsuccessful</a>
	            </center>
            </div>
            <?php
		}
	}
    else{
		?>
		<div>
	        <center>
		        <a class="Checkout_Page_Confirmation" href="Book Now.php">All Fields Required</a>
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
<title>Booking Page</title>
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
<form class="Appoint-Button" method="get" action="Make An Appointment Page.html">
	<button><strong>&lt</strong> Back </button>
</form>
<!-- Booking Session Page -->
<form class="Form-Style-Appointment" action="Book Now.php" method="post">
	<center><legend>Book Now</legend></center>
   	<input class="Form-Style-Appointment-1" type="text" name="firstname" placeholder="First Name" required>
    <br>
    <input class="Form-Style-Appointment-1" type="text" name="lastname" placeholder="Last Name" required>
    <br>
    <input class="Form-Style-Appointment-1" type="text" name="email" placeholder="Email" required>
    <br>
    <input type="tel" name="phone" id="Phone" placeholder="Phone Number" autocomplete="on" required>
    <br>
    <textarea name="message" placeholder="Message" required></textarea>
	<br>
    <center>
		<button type="submit" name="submit">SUBMIT</button>
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