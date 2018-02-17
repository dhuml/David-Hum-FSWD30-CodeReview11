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
	$res = mysqli_query($conn, "SELECT * FROM customer WHERE customer_id=" . $_SESSION['customer']);
	$customerRow = mysqli_fetch_array($res, MYSQLI_ASSOC);
 ?>

<!DOCTYPE html>
<html>
<head>

	<title>Welcome - <?php echo $customerRow['']; ?></title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


	<style>
		.bg-custom {
			background-image: url('');
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

		
			<h1 class="display-2">Big Library</h1>	

			<br >
			<br >

			<p class="lead">Hello <?php echo $customerRow['first_name'] . " " . $customerRow['last_name']; ?>
			</p>
	 
			
			<hr class="my-4">

			<a class="btn btn-primary btn-lg" href="logout.php?logout">Log Out</a>		
	</div>
</header>

</header>
	
<main>
	
	<?php 
	echo "<div class='container'>";
		$mysqli = new mysqli('localhost', 'root', '', 'cr11_david_huml_php_car_rental');

		if (!$mysqli) {
			print "<h1>Unable to connect to MySQL</h1>";
		}

		// sql statement alle autos anzeigen

		$sql_statement = "SELECT adress, city, office_lat, office_long, model, manufacturer, office_id ";
		$sql_statement .= "FROM cars_location ";
		$sql_statement .= "INNER JOIN cars on cars_location.fk_car_id = cars.car_id ";
		$sql_statement .= "INNER JOIN offices on cars_location.fk_office_id = offices.office_id ";
		// if ( $_GET['category'] ) {
		// 	$sql_statement .= "WHERE offices.adress ='" . $_GET['category'] .  "'";}
		
		$result = $mysqli->query($sql_statement);

		// sql statement für publisher liste

		// $sql_statement2 = "SELECT adress ";
		// $sql_statement2 .= "FROM cars_location ";
		// $sql_statement2 .= "INNER JOIN offices on cars_location.fk_office_id = offices.office_id";
		
		// $result2 = $mysqli->query($sql_statement2);


		if (!$result) {
			$outputDisplay = "<p>MySQL No: " . $mysqli->errno . "</p>";
			$outputDisplay .= "<p>MySQL Error: " . $mysqli->error . "</p>";
			$outputDisplay .= "<p>SQL Statement: " . $sql_statement . "</p>";
			$outputDisplay .= "<p>MySQL Affected Rows: " . $mysqli->affected_rows . "</p>";
			echo $outputDisplay;

			} else {
			$outputDisplay = "query succesfull";
			};

		$rows = $result->fetch_all(MYSQLI_ASSOC);
		

		// location output

			
			foreach ($rows as $row) {

			echo "<div class='row my-4'>";
				echo "<div class='col flex-column d-flex align-items-center '>";


				echo "<div id='map" . $row['office_id'] . "' style='height:250px;width:350px'></div>";



				echo "</div>";
				echo "<div class='col flex-column d-flex align-items-center'>";				
				echo "	<h3>" . $row['adress'] .  " " . $row['city'] . "</h3>";
				echo "<a href='cars_list.php?category=" . $row['adress'] . "' class='btn btn-lg'>Availavle Cars at This Location</a >";
				echo "</div>";
			echo "</div>";
				
			}

			
			echo "</div>";

	 ?>

</main>

	<script>
		    
		    function initMap() {
		        
		        <?php
		        foreach ($rows as $row) {
		        	
		        echo "var uluru" . $row['office_id'] . " = {lat: " . $row['office_lat'] . ", lng: " . $row['office_long'] . "};";
		        echo "var map" 
		        	. $row['office_id'] .
		        	 " = new google.maps.Map(document.getElementById('map"
		        	. $row['office_id'] . 
		        	"'),";	
		        echo	"{	zoom: 15,
		        		    center: uluru" . $row['office_id'] . "
		        		        });";
		        echo "var marker" . $row['office_id'] ." = new google.maps.Marker({
		          position: uluru" . $row['office_id'] . ",
		          map: map" . $row['office_id'] . "
		        });";
		        	 }?>
		      }
	</script>

	<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAM87OfL6uE5QHEWDO0O4wviMKBsUNUN7Y&callback=initMap">
    </script>


	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>

<?php ob_end_flush(); ?>