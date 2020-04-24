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

<form>
	Termék neve <input type="text"><br>
	Kategória 
	<select name="category">
		<option value="regi">Régiségek</option>
		<option value="jarmu">Járművek</option>
	</select><br>
	Kezdő licit <input type="number"><br>
	Leírás <textarea rows="12" cols="50"></textarea><br>
	Képek feltöltése:<br>
	<input type="file" name="pic1">
	<input type="file" name="pic2">
	<input type="file" name="pic3">
	<input type="file" name="pic4">
	<input type="file" name="pic5">
	<input type="file" name="pic6"><br>
	<input type="checkbox" id="aszf">
	<label for="aszf">Elolvastam az és megértettem az <a href="aszf.php" target="_blank">Általános Szerződési Feltételeket</a></label><br>
	<input type="submit" value="Hirdetésfeladás">


</form>

</body>
</html>