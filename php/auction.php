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
//$result = $mysqli->query($sql);
/*while($row = $result->fetch_assoc()) {
	$nev = $row["nev"];
	$kategoria = $row["kategoria"];
	$kezdo_licit = $row["kezdo_licit"];
	$aktualis_licit = $row["aktualis_licit"];
	$kep1 = $row["kep1"];
	$kep2 = $row["kep2"];
	$kep3 = $row["kep3"];
	$leiras = $row["leiras"];
	$username = $row["username"];
}*/

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
					$nyertes = $row["nyertes_user"];
					$result->free();
			}
			
		mysqli_free_result($result);
		}
	}while(mysqli_next_result($mysqli));
}




/*$sql1 = "SELECT COUNT(*) AS sorok FROM kedvencek WHERE termek_id='$id' AND username='$my_username'";
$result1 = $mysqli->query($sql);
if($result1->num_row >0 ){
	$sorok_szama = $result1->fetch_assoc();
}*/

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
	echo "Nyertes user: ".$nyertes."<br>";
echo "</div>";
	//licitálás
	echo "<form enctype='multipart/form-data' action='bid.php?id=".$id."' method='post'>";
	echo "Mennyit ér neked? <input type='number' name='uj_licit' id='uj_licit'>";
	echo "<input type='submit' value='Licitálok'>";
	echo "</form>";
	//aukció vége
	echo "Hátralévő idő: <p id='visszaszamlalo'></p>";
	//kedvencek
	if($sorok_szama == 0){
		echo "<form enctype='multipart/form-data' action='add_star.php?id=".$id."' method='post'>";
		echo "<input type='submit' value='Hozzáadás a kedvencekhez'>";
		echo "</form>";

	}else{
		echo "<form enctype='multipart/form-data' action='remove_star.php?id=".$id."' method='post'>";
		echo "<input type='submit' value='Eltávolítás a kedvencek közül'>";
		echo "</form>";
	}
	
		echo "<form action='welcome.php' method='post'>";
		echo "	";
		echo "<input type='submit' value='Vissza a főmenübe'>";
		echo "</form>";

?>

</body>





<script>
// Set the date we're counting down to

var end = "<?php echo $aukcio_vege ?>";


var countDownDate = new Date(end).getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="visszaszamlalo"
  document.getElementById("visszaszamlalo").innerHTML = days + "nap " + hours + "óra "
  + minutes + "perc " + seconds + "másodperc ";

  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("visszaszamlalo").innerHTML = "LEJÁRT";		
  }
}, 1000);




</script>


</html>

