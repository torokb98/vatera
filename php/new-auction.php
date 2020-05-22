<?php

session_start();
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
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
	<title>Hirdetésfeladás</title>
</head>
<body>
<div id="page-container">
<div id="content-wrap">
<h1>Hirdetésfeladás</h1>

<form enctype="multipart/form-data" action="insert.php" method="POST">
	Termék neve <input type="text" name="nev" id="nev"><br>
	Kategória 
	<select name="kategoria" id="kategoria">
		<option value="x" hidden selected>Kérjük válasszon</option>
		<option value="Műszaki cikk">Műszaki cikk</option>
		<option value="Régiség">Régiség</option>
		<option value="Jármű">Jármű</option>
		<option value="Divat">Divat</option>
		<option value="Sport">Sport</option>
		<option value="Egyéb">Egyéb</option>
	</select> <b hidden name="hiba2" id="hiba2">Kérjük válasszon kategóriát!  </b> <br>
	Kezdő licit <input type="number" name="licit" id="licit" onchange="enableSubmit()"> <b hidden name="hiba" id="hiba">Nem megfelelő a kezdő licit.  </b> <br>
	Aukció vége <input type="datetime-local" name="aukcio_vege" id="aukcio_vege" value="<?php echo $datum7d; ?>" min="<?php echo $aktualis_datum?>" max="<?php echo $datum1y; ?>"><br>
	Leírás <textarea rows="12" cols="50" name="leiras" id="leiras"></textarea><br>
	Képek feltöltése:<br>
	<input type="hidden" name="MAX_FILE_SIZE" value="1073741824" />
	<input type="file" name="pic1">
	<input type="file" name="pic2">
	<input type="file" name="pic3">
	<br>
	<input type="checkbox" id="aszf" onclick="enableSubmit()">
	<label for="aszf">Elolvastam az és megértettem az <a href="aszf.php" target="_blank">Általános Szerződési Feltételeket</a></label><br>
	<input type="submit" value="Hirdetésfeladás" id="submitBtn" disabled>
</form>
<form action="welcome.php" method="post">
	<input type="submit" value="Mégsem">
</form>


<script>


function enableSubmit(){
	var checkbox = document.getElementById("aszf");
	if(document.getElementById("licit").value <= 0)
	{
	    document.getElementById("hiba").hidden = false;
	    if(checkbox.checked == true){
	        document.getElementById("submitBtn").disabled = true;
	    }

	}
	else{
	    document.getElementById("hiba").hidden = true;
	    if (checkbox.checked == true){
        	    document.getElementById("submitBtn").disabled = false;
        	} else {
        		document.getElementById("submitBtn").disabled = true;
        	}

	}

}


</script>
<div>
<footer>
	<p>Pannon Egyetem 2020</p>
</footer>
<div>
</body>

</html>





