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
	<title>Welcome</title>
</head>
<body>
<div id="page-container">
<div id="content-wrap">



	
	
	<div class="w3-top">
	  <div class="w3-bar w3-black w3-card w3-center w3-large">
		
		<a href="#" class="w3-bar-item w3-button w3-padding-large w3-black">Kezdőoldal</a>
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
	$sql = "SELECT id, nev, kep1, aktualis_licit FROM termekek WHERE lejart=0";
	$alap = $nevasc = $nevdesc = $arasc = $ardesc = "";
	$osszes = $muszaki = $regi = $jarmu = $divat = $sport = $egyeb = "";
	$check = "";
	
	
	if ($_GET['keres'] != null && $_GET['leiras'] == "igen")
	{
		$sql .= " AND nev like '%".$_GET['keres']."%' ";
		$sql .= " OR leiras like '%".$_GET['keres']."%' ";
		$check = " checked";
	}
	elseif ($_GET['keres'] != null)
	{
		$sql .= " AND nev like '%".$_GET['keres']."%' ";
	}
	
		switch ($_GET['kategoria']){
		case 'ossz':
			$osszes = " selected";
			break;
		case 'muszaki':
			$sql .= " AND kategoria='Műszaki cikk'";
			$muszaki = " selected";
			break;
		case 'regiseg':
			$sql .= " AND kategoria='Régiség'";
			$regi = " selected";
			break;
		case 'jarmu':
			$sql .= " AND kategoria='Jármű'";
			$jarmu = " selected";
			break;
		case 'divat':
			$sql .= " AND kategoria='Divat'";
			$divat = " selected";
			break;
		case 'sport':
			$sql .= " AND kategoria='Sport'";
			$sport = " selected";
			break;
		case 'egyeb':
			$sql .= " AND kategoria='Egyéb'";
			$egyeb = " selected";
			break;
	}
	
	
	
	switch ($_GET['rendez']){
		case 'nev ASC':
			$sql .= " ORDER BY nev ASC";
			$nevasc = " selected";
			break;
		case 'nev DESC':
			$sql .= " ORDER BY nev DESC";
			$nevdesc = " selected";
			break;
		case 'ar ASC':
			$sql .= " ORDER BY aktualis_licit ASC";
			$arasc = " selected";
			break;
		case 'ar DESC':
			$sql .= " ORDER BY aktualis_licit DESC";
			$ardesc = " selected";
			break;
	}
	
	
	
	$result = $mysqli->query($sql);
?>

<form align='center' action="welcome.php">
	<label for="rendez">Rendezés:</label>
	<select id="rendez" name="rendez">
		<option value="def" <?php echo $alap; ?>>Alapértelmezett</option>
		<option value="nev ASC" <?php echo $nevasc; ?>>ABC szerint növekvő</option>
		<option value="nev DESC" <?php echo $nevdesc; ?>>ABC szerint csökkenő</option>
		<option value="ar ASC" <?php echo $arasc; ?>>Ár szerint növekvő</option>
		<option value="ar DESC" <?php echo $ardesc; ?>>Ár szerint csökkenő</option>
	</select>
	<input type="submit" value="Rendezés">

	<label for="keres">Keresés:</label>
	<input id="keres" name="keres" type="text" <?php echo "value=".$_GET['keres']; ?>>
	
	<label for="kat">Kategória:</label>
	<select name="kategoria" id="kategoria">
		<option value="ossz" <?php echo $osszes; ?>>Összes</option>
		<option value="muszaki" <?php echo $muszaki; ?>>Műszaki cikk</option>
		<option value="regiseg" <?php echo $regi; ?>>Régiség</option>
		<option value="jarmu" <?php echo $jarmu; ?>>Jármű</option>
		<option value="divat" <?php echo $divat; ?>>Divat</option>
		<option value="sport" <?php echo $sport; ?>>Sport</option>
		<option value="egyeb" <?php echo $egyeb; ?>>Egyéb</option>
	</select>
	<input type="checkbox" id="leiras" value="igen" name="leiras" <?php echo $check; ?>>
	<label for="leiras">Keresés a leírásban is</label>
	<br>
	<input type="submit" style="width:150px" value="Keresés">
	
</form>

<form align='center' action="welcome.php">
	<input type="submit" style="width:150px" value="Feltételek törlése">
</form><br>

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
		echo "<td>".$row["aktualis_licit"]." Ft</td>";
		echo "</tr>";
    }
	echo "</table>";
	} else {
    echo "<h3 align='center'>Nincs aktív aukció!</h3>";
	}
	
	$mysqli->close();
	
	?>
	
<br><br>
<div>
<footer>
	<p>Pannon Egyetem 2020</p>
</footer>
</div>
</body>
</html>