<?php

session_start();
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
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
</style>
<head>
	<title>Welcome</title>
</head>
<body>


    <div class="page-header" align="center">
        <h1>Üdvözöljük <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>!</h1>
    </div>
    <h4 align="center" >
		<a href="new-auction.php" class="btn btn-warning" align="center" >Hirdetésfeladás</a>&nbsp;
		<a href="my-auctions.php" class="btn btn-warning" align="center"> Hirdetéseim </a>&nbsp;
		<a href="stars.php" class="btn btn-warning" align="center"> Kedvenceim </a>&nbsp;
        <a href="reset-password.php" class="btn btn-warning" align="center"> Új jelszó létrehozása </a>&nbsp;
        <a href="logout.php" class="btn btn-danger" align="center"> Kijelentkezés </a>
    </h4>
	<br><br><br>
	<h3 align="center">
	<?php 
	require_once "config.php";
	$sql = "SELECT id, nev FROM termekek";
	$result = $mysqli->query($sql);

	if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		$id = $row["id"];
        echo "<br><a  href='auction.php?id=".$id."'><font color=blue><b>". $row["nev"]. "</b></a><br>";
    }
	} else {
    echo "Nincs aktív aukció!";
	}
	
	$mysqli->close();
	
	?>
	</h3>


</body>
</html>