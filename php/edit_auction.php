<?php

session_start();
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
$id = $_GET['id'];
$my_username = $_SESSION["username"];
require_once "config.php";
$sql = "SELECT * FROM termekek WHERE id='$id'; ";
$sql .= "SELECT COUNT(*) AS sorok FROM kedvencek WHERE termek_id='$id' AND username='$my_username'; ";

if(mysqli_multi_query($mysqli, $sql)){
	do{
		if ($result = mysqli_store_result($mysqli)) {
			
			while ($row = mysqli_fetch_array($result)){
					$sorok_szama = $row["sorok"];
					if($sorok_szama != NULL){
						break;
					}
					$nev = $row["nev"];
					$kategoria = $row["kategoria"];
					$kezdo_licit = $row["kezdo_licit"];
					$aktualis_licit = $row["aktualis_licit"];
					$kep1 = $row["kep1"];
					$kep2 = $row["kep2"];
					$kep3 = $row["kep3"];
					$leiras = $row["leiras"];
					$username = $row["username"];
					$aukcio_vege = $row["aukcio_vege"];
					$result->free();
			}
			
		mysqli_free_result($result);
		}
	}while(mysqli_next_result($mysqli));
}

$mysqli->close();

date_default_timezone_set("Europe/Budapest");
//aktuális dátum
$aktualis_datum = date("Y-m-d")."T".date("H:i");

//aktuális dátum + 7nap
$nap7d = strtotime("+7 day");
$nap7d = date("Y-m-d", $nap7d);
$ido7d = date("H:i");
$datum7d = $nap7d."T".$ido7d;

//aktuális dátum + 1év
$nap1y = strtotime("+1 year");
$nap1y = date("Y-m-d", $nap1y);
$ido1y = date("H:i");
$datum1y = $nap1y."T".$ido1y;

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
	<title><?php echo $nev; ?> szerkesztése</title>
</head>
<body>
<h1>Hirdetés szerkesztése</h1>
<form enctype="multipart/form-data" action="edit.php?id=<?php echo $id; ?>" method="POST">
	Termék neve <input type="text" name="nev" id="nev" value="<?php echo $nev; ?>"><br>
	Kategória 
	<select name="kategoria" id="kategoria" value="<?php echo $kategoria; ?>">
		<option value="Régiség">Régiségek</option>
		<option value="Jármű">Járművek</option>
	</select><br>
	Aukció vége <input type="datetime-local" name="aukcio_vege" id="aukcio_vege" value="<?php echo $datum7d; ?>" min="<?php echo $aktualis_datum?>" max="<?php echo $datum1y; ?>"><br>
	Leírás <textarea rows="12" cols="50" name="leiras" id="leiras"><?php echo $leiras; ?></textarea><br>
	<br>
	
	<input type="submit" value="Hirdetés módosítása" id="submitBtn">
</form>
<form action="my-auctions.php" method="post">
	<input type="submit" value="Mégsem">
</form>
<form action="welcome.php" method="post" style='position:absolute;bottom:50px;left:10px;'>
	<input type="submit" value="Vissza a főmenübe">
</form>



</body>



</html>

