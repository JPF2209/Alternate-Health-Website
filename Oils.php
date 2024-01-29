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

//Adding Item To The Shopping Cart//
if(isset($_POST["add_to_bag"]))
{
	if(isset($_SESSION["shopping_cart"]))
	{
		$item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
		if(!in_array($_POST["id"], $item_array_id))
		{
    
			$count = count($_SESSION['shopping_cart']);		
			$item_array = array
			(
				'item_id' => $_POST["id"],
			    'item_name' => $_POST["hidden_name"],
			    'item_price' => $_POST["hidden_price"],
			    'item_quantity' => $_POST["quantity"]
			);				
			$_SESSION["shopping_cart"][$count] = $item_array;
		}
		else
		{			
		}
    }
    else
	{
		$item_array = array
		(
			'item_id' => $_POST["id"],
			'item_name' => $_POST["hidden_name"],
			'item_price' => $_POST["hidden_price"],
			'item_quantity' => $_POST["quantity"]
		);
		$_SESSION["shopping_cart"][0] = $item_array;		
	}
}

?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Oils Selection</title>
<link rel="stylesheet" href="Styling The Website.css" >
<link rel="icon" type="image/x-icon" href="Images/company logo.jpg">
	
<!-- Font For Website -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@500&display=swap" rel="stylesheet">

<!-- Picture & Title For Header -->
<section class="Title">
	<a href="The Home Page.html"><img src="Images/company logo.jpg" alt=" " width="130" length="130" loading="lazy"></a>
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
	
<!--<div>-->
	<!-- Area where I'm loading my items into the storefront -->
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
	<section class="cards">
    <?php
	    //Grabbing values from database
        $sql = "SELECT id, images, name, price, description FROM oils_info";
        $result = mysqli_query($conn, $sql);
	
	    //displaying values to audience 
        if (mysqli_num_rows($result) > 0) 
    	{
          // output data of each row
          while($row = mysqli_fetch_array($result)) 
	      {
        
    ?>
	
<!-- Store Items List/The Store Items Themselves On Display -->	

<article class="card">
	<form method="post" action="Oils.php"?action=add&id" <?php echo $row["id"]; ?>>
		<div>
		<br>
   	    <img src="Images/<?=$row['images']; ?>" alt= " " width=200; length=200;> </div>
        <div><h2> <?= $row['name']; ?> </h2>
   	    </div>
   	    <div>
		    <p><b>$<?=$row['price']; ?></b></p>
		</div>
    	<div>
   		    <aside>			
    	    	<details>
					<summary>
		   	    		<strong>Desctiption</strong>
		        	</summary>
					<center><p class="card-alt"><?= $row['description']; ?></p></center>				
	            </details>			
		    </aside>
   	    </div>
	    <br>
        <div class="card-alt">
   	    	<input type="number" name="quantity" placeholder="Enter Quantity" step="1" required>
        </div>
		<br>
        <div class="card-Button" >
    	    <input type="submit" name="add_to_bag" value="Add To Bag">
        </div>
	    <div>
   	    	<input type="hidden" name="id" value="<?= $row['id']; ?>">
        </div>
   	    <div>
    	    <input type="hidden" name="hidden_name" value="<?= $row['name']; ?>">
        </div>
        <div>
		    <input type="hidden" name="hidden_price" value="<?= $row['price']; ?>">
        </div>
		<br>
    </form>
</article>

	       
        
	
    <?php
        }
        } 
	    else 
        {
          echo "0 results";
        }
    ?>
</section>  


<!-- Buttons For The Other Sections Of The Website -->	
<center class="Store-Button-Links">
	<form method="get" action="Checkout Page.php">
	    <button >Checkout</button>
    </form>
	<br>
	<form method="get" action="Meditation Balls.php">
	    <button>Meditation Balls</button>
    </form>
</center>
	
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