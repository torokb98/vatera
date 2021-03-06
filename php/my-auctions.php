<?php

session_start();
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
	$my_username = htmlspecialchars($_SESSION["username"]);

?>
 



<!DOCTYPE html>
<html lang="hu">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>

body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif}
.w3-bar,h1,button {font-family: "Montserrat", sans-serif}
.fa-anchor,.fa-coffee {font-size:200px}

body{
  background-image: url(welcome.jpg);
  background-position: center center;
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
  background-color:#464646;

}

table, th, td {
  border: 1px solid black;
  background-color: white;
}

footer {
  position: absolute;
  bottom: 0;
  width: 100%;
  text-align: center;
  padding: 3px;
  background-color: Black;
  color: white;
}

#page-container {
  position: relative;
  min-height: 100vh;
}

#content-wrap {
  padding-bottom: 2.5rem;    /* Footer height */
}

</style>
<head>
	<title>Hirdetéseim</title>
</head>
<body>


	<div class="w3-top">
	  <div class="w3-bar w3-black w3-card w3-center w3-large">
		
		
		
		<a href="welcome.php" class="w3-bar-item w3-button w3-padding-large w3-white">Kezdőoldal</a>
		<a href="new-auction.php" class="w3-bar-item w3-button w3-padding-large w3-white">Hirdetesfeladás</a>
		<a href="#" class="w3-bar-item w3-button w3-padding-large w3-black">Hirdetéseim</a>
		<a href="stars.php" class="w3-bar-item w3-button w3-padding-large w3-white">Kedvenceim</a>
		<a href="reset-password.php" class="w3-bar-item w3-button w3-padding-large w3-white">Új jelszó létrehozása</a>
		<a href="logout.php" class="w3-bar-item w3-button w3-padding-large w3-white">Kijelentkezés</a>
	  </div>

	</div>




<br><br>
<div id="page-container">
<div id="content-wrap">
	<div align="center">
        <h1><b><?php echo $my_username ?></b> hirdetései</h1>
    </div>

	<!--h3 align="center"-->
	<?php
	
	require_once "config.php";
	$sql = "SELECT id, nev, kep1, aktualis_licit FROM termekek WHERE username = '".$my_username."'";
	$osszes = $aktiv = $lejart = "";
	
	
	
			switch ($_GET['stat']){
		case 'ossz':
			$osszes = " selected";
			break;
		case 'aktiv':
			$sql .= " AND lejart=0";
			$aktiv = " selected";
			break;
		case 'lejart':
			$sql .= " AND lejart=1";
			$lejart = " selected";
			break;
			}
	
		$result = $mysqli->query($sql);
	
	
	?>
	
	
<form align='center' action="my-auctions.php">	
		<label for="kat">Státusz:</label>
	<select align="center" name="stat" id="stat">
		<option value="ossz" <?php echo $osszes; ?>>Összes</option>
		<option value="aktiv" <?php echo $aktiv; ?>>Aktív</option>
		<option value="lejart" <?php echo $lejart; ?>>Lejárt</option>
	</select>
		<br><br>
	<input type="submit" value="Keresés">
</form>
<br>
<?php


	
	

	if ($result->num_rows > 0) {
		// output data of each row
		echo "<table align='center' width='75%'>";
		while($row = $result->fetch_assoc()) {
			$id = $row["id"];
			echo "<tr>";
			if($row['kep1'] != null){
				echo "<td align='center' width='300px'><a href='auction.php?id=".$id."'><img src=kepek\\".$row["kep1"]." width='200'></a></td>";
			}
			else{
				echo "<td align='center' width='300px'><a href='auction.php?id=".$id."'><img src=nincs-kep.jpg width='200'></a></td>";
			}
			echo "<td><a href='auction.php?id=".$id."'>".$row["nev"]."</a></td>";
			echo "<td><a href='edit_auction.php?id=".$id."'>Szerkesztés</a>";
			echo "<br><a href='delete.php?id=".$id."'>Törlés</a></td>";
			echo "</tr>";
		}
		echo "</table>";
	} else {
		echo "<h3 align='center'>Nincs aktív aukció!</h3>";
	}
	

	
	
	$mysqli->close();
	
	?>
	</div>	



</body>


</html>