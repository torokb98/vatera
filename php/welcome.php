<?php

session_start();
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

    $order = isset($order) ? $order : $_GET['rendez'];
	$search = isset($search) ? $search : $_GET['keres'];
	//$order = $_GET['rendez'];
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
}

</style>
<head>
	<title>Welcome</title>
</head>
<body>




	
	
	<div class="w3-top">
	  <div class="w3-bar w3-black w3-card w3-center w3-large">
		
		<a href="new-auction.php" class="w3-bar-item w3-button w3-padding-large w3-white">Hirdetesfeladás</a>
		<a href="my-auctions.php" class="w3-bar-item w3-button w3-padding-large w3-white">Hirdetéseim</a>
		<a href="stars.php" class="w3-bar-item w3-button w3-padding-large w3-white">Kedvenceim</a>
		<a href="reset-password.php" class="w3-bar-item w3-button w3-padding-large w3-white">Új jelszó létrehozása</a>
		<a href="logout.php" class="w3-bar-item w3-button w3-padding-large w3-white">Kijelentkezés</a>
	  </div>

	</div>
	
	<br><br><br>
	
	<div class="page-header" align="center">
        <h1>Üdvözöljük <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>!</h1>
    </div>
	

	
	<?php 
	require_once "config.php";
	$sql = "SELECT id, nev, kep1, aktualis_licit FROM termekek";
	$alap = $nevasc = $nevdesc = $arasc = $ardesc = " ";
	
	if ($_GET['keres'] != null)
	{
		$sql .= " WHERE nev like '%".$_GET['keres']."%' ";
	}
	
	if ($_GET['rendez'] == 'nev ASC')
	{
		$sql .= " ORDER BY nev ASC";
		$nevasc = " selected";
	}
	elseif ($_GET['rendez'] == 'nev DESC')
	{
		$sql .= " ORDER BY nev DESC";
		$nevdesc = " selected";
	}
	elseif ($_GET['rendez'] == 'ar ASC')
	{
		$sql .= " ORDER BY aktualis_licit ASC";
		$arasc = " selected";
	}
	elseif ($_GET['rendez'] == 'ar DESC')
	{
		$sql .= " ORDER BY aktualis_licit DESC";
		$ardesc = " selected";
	}
	
	
	
	$result = $mysqli->query($sql);
?>

	<form action="welcome.php">
	  <label for="rendez">Rendezés:</label>
	  <select id="rendez" name="rendez">
		<option value="def" <?php echo $alap; ?>>Alapértelmezett</option>
		<option value="nev ASC" <?php echo $nevasc; ?>>ABC szerint növekvő</option>
		<option value="nev DESC" <?php echo $nevdesc; ?>>ABC szerint csökkenő</option>
		<option value="ar ASC" <?php echo $arasc; ?>>Ár szerint növekvő</option>
		<option value="ar DESC" <?php echo $ardesc; ?>>Ár szerint csökkenő</option>
	  </select>
	  <input type="submit" value="Rendezés">
	</form><br>
	<form action="welcome.php">
		<label for="keres">Keresés:</label>
		<input id="keres" name="keres" type="text" <?php echo "value=".$_GET['keres']; ?>>
		<input type="submit" value="Keresés">
	</form><br>

<?php

	if ($result->num_rows > 0) {
    // output data of each row
	echo "<table align='center' width='75%'>";
    while($row = $result->fetch_assoc()) {
		$id = $row["id"];
        echo "<tr>";
		if($row['kep1'] != null){
			echo "<td width='300px'><a href='auction.php?id=".$id."'><img src=kepek\\".$row["kep1"]." width='200'></a></td>";
		}
		else{
			echo "<td width='300px'><a href='auction.php?id=".$id."'><img src=nincs-kep.jpg width='200'></a></td>";
		}
		echo "<td><a href='auction.php?id=".$id."'>".$row["nev"]."</a></td>";
		echo "<td>".$row["aktualis_licit"]." Ft</td>";
		echo "</tr>";
    }
	echo "</table>";
	} else {
    echo "<h3 align='center'>Nincs aktív aukció!</h3>";
	}
	
	$mysqli->close();
	
	?>
	


</body>
</html>