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
</style>
<head>
	<title>Hirdetéseim</title>
</head>
<body>
	<div class="page-header" align="center">
        <h1><b><?php echo $my_username ?></b> hirdetései</h1>
    </div>
	<br><br><br>
	<!--h3 align="center"-->
	<?php
	require_once "config.php";
	$sql = "SELECT id, nev, kep1 FROM termekek WHERE username = '".$my_username."'";
	$result = $mysqli->query($sql);

	if ($result->num_rows > 0) {
		// output data of each row
		echo "<table>";
		while($row = $result->fetch_assoc()) {
			$id = $row["id"];
			echo "<tr>";
			echo "<td><a href='auction.php?id=".$id."'><img src=kepek\\".$row["kep1"]." width='200' ></a></td>";
			echo "<td><a href='auction.php?id=".$id."'>".$row["nev"]."</a></td>";
			echo "<td><a href='edit_auction.php?id=".$id."'>Szerkesztés</a></td>";
			echo "</tr>";
		}
		echo "</table>";
	} else {
		echo "<h3 align='center'>Nincs aktív aukció!</h3>";
	}
	
	
	$mysqli->close();
	
	?>
	<!--/h3-->


</body>
</html>