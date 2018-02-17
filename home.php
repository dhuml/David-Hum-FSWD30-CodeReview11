<?php 
	ob_start();
	session_start();
	require_once 'dbconnect.php';

	//if session is not set this will redirect to login page

	if( !isset($_SESSION['customer'])) {
		header("Location: index.php");
		exit;
	}

	// select logged-in users detail
	$res = mysqli_query($conn, "SELECT * FROM customer WHERE customer_id=" .$_SESSION['customer']);
	$customerRow = mysqli_fetch_array($res, MYSQLI_ASSOC);
 ?>

<!DOCTYPE html>
<html>
<head>

	<title>Welcome - <?php echo $customerRow['first_name'] . " " . $customerRow['first_name']; ?></title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


	<style>
		.bg-custom {
			background-image: url('img/library.jpg');
			opacity: 0.7;
		}
	</style>

</head>
<body>
<header>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		
		<a class="navbar-brand" href="home.php">PHP CAR RENTAL</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link" href="home.php">Home<span class="sr-only">(current)</span></a>
				</li>
			    <li class="nav-item">
			    	<a class="nav-link" href="office_list.php">Our Offices</a>
			    </li>
			   	<li class="nav-item">
			    	<a class="nav-link" href="cars_list.php">Our Cars</a>
			    </li>
	    	</ul>
	 	</div>
	</nav>

<div class="jumbotron d-flex flex-column border align-items-center bg-custom">

	
		<h1 class="display-2">PHP Car Rental</h1>	

		<br >
		<br >

		<p class="lead">Hi' <?php echo $customerRow['first_name'] . " " . $customerRow['last_name']; ?>
		</p>
 
		
		<hr class="my-4">

		<a class="btn btn-primary btn-lg" href="logout.php?logout">Log Out</a>
	
</div>

</header>
	
<main>


<div class="container">
	<div class="row">
		<div class="col d-flex flex-column justify-contetnt-end align-items-center border">
			
		
			<div class="card" style="width: 18rem;">
			  <img class="card-img-top" src="..." alt="Card image cap">
			  <div class="card-body d-flex flex-column justify-contetnt-center">
			    <h5 class="card-title">Our Cars</h5>
			    <p class="card-text">Find a list of all cars we offer.</p>
			    <a href="cars_list.php" class="btn btn-primary">Our Cars</a>
			  </div>
			</div>
		</div>
		<div class="col d-flex flex-column justify-contetnt-end align-items-center border">
			
			<div class="card" style="width: 18rem;">
			  <img class="card-img-top" src="..." alt="Card image cap">
			  <div class="card-body d-flex flex-column justify-contetnt-center">
			    <h5 class="card-title">Our Offices</h5>
			    <p class="card-text">These are the Places Where you can find us in Vienna</p>
			    <a href="office_list.php" class="btn btn-primary">Our Offices</a>
			  </div>
		</div>
	</div>
	</div>

</div>	
		
</main>



	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>

<?php ob_end_flush(); ?>