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
</style>
<head>
	<title>Hirdetésfeladás</title>
</head>
<body>

<h1>Hirdetésfeladás</h1>

<form enctype="multipart/form-data" action="insert.php" method="POST">
	Termék neve <input type="text" name="nev" id="nev"><br>
	Kategória 
	<select name="kategoria" id="kategoria">
		<option value="Régiség">Régiségek</option>
		<option value="Jármű">Járművek</option>
	</select><br>
	Kezdő licit <input type="number" name="licit" id="licit" onchange="enableSubmit()"> <p hidden name="hiba" id="hiba">Nem megfelelő a kezdő licit.  </p> <br>
	Leírás <textarea rows="12" cols="50" name="leiras" id="leiras"></textarea><br>
	Képek feltöltése:<br>
	<input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
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

</body>

</html>





