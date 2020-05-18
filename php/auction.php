<?php

session_start();
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
$id = $_GET['id'];
require_once "config.php";
$sql = "SELECT * FROM termekek WHERE id=".$id;
$result = $mysqli->query($sql);
while($row = $result->fetch_assoc()) {
	$nev = $row["nev"];
	$kategoria = $row["kategoria"];
	$kezdo_licit = $row["kezdo_licit"];
	$aktualis_licit = $row["aktualis_licit"];
	$kep1 = $row["kep1"];
	$kep2 = $row["kep2"];
	$kep3 = $row["kep3"];
	$leiras = $row["leiras"];
	$username = $row["username"];
}
$mysqli->close();
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
  background-image: url(auction.jpg);
  background-position: center center;
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
  background-color:#464646;

}
</style>

<head>
	<title><?php echo $nev; ?></title>
</head>
<body>
<div  style="text-align:center">
<h1><?php echo $nev; ?></h1>
</div>
<?php
echo "<div style='display:block;margin:0 auto;text-align:center;'>";
if(@GetImageSize("kepek\\".$kep1)){						//display only if exists
		echo "<img src=kepek\\".$kep1." width='400' >";
	}
if(@GetImageSize("kepek\\".$kep2)){
		echo "<img src=kepek\\".$kep2." width='400' >";
	}
	
if(@GetImageSize("kepek\\".$kep3)){
		echo "<img src=kepek\\".$kep3." width='400' >";
	}
echo "</div>";
	echo "<div style='text-align:center'>";
	echo "<br><br><br>";
	echo "Kategória: ".$kategoria."<br>";
	echo "Leírás: ".$leiras."<br>";
	echo "Aktuális licit: ".$aktualis_licit."<br>";
	echo "Kezdőlicit: ".$kezdo_licit."<br>";
	echo "</div>";
	//licitálás
	echo "<form enctype='multipart/form-data' action='bid.php?id=".$id."' method='post'>";
	echo "Mennyit ér neked? <input type='number' name='uj_licit' id='uj_licit'>";
	echo "<input type='submit' value='Licitálok'>";
	echo "</form>";
	//kedvencek
	echo "<form enctype='multipart/form-data' action='add_star.php?id=".$id."' method='post'>";
	echo "<input type='submit' value='Hozzáadás a kedvencekhez'>";
	echo "</form>";
?>

<form action="welcome.php" method="post" style='position:absolute;bottom:50px;left:10px;'>
	<input type="submit" value="Vissza a főmenübe">
</form>


</body>

</html>

