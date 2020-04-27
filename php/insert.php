 <?php
	session_start();

	require_once "config.php";

	$nev = $mysqli->real_escape_string($_REQUEST['nev']);
	$kategoria = $mysqli->real_escape_string($_REQUEST['kategoria']);
	$licit = $mysqli->real_escape_string($_REQUEST['licit']);
	$leiras = $mysqli->real_escape_string($_REQUEST['leiras']);
	$pic1 = $mysqli->real_escape_string($_REQUEST['pic1']);
	$pic2 = $mysqli->real_escape_string($_REQUEST['pic2']);
	$pic3 = $mysqli->real_escape_string($_REQUEST['pic3']);
	$uname = htmlspecialchars($_SESSION["username"]);
	 
	$sql = "INSERT INTO termekek (nev, kategoria, kezdo_licit, kep1, kep2, kep3, leiras, username) VALUES ('$nev', '$kategoria', '$licit', '".$pic1."', '".$pic2."', '".$pic3."', '".$leiras."', '$uname')";
	if($mysqli->query($sql) === true){
		echo "A hirdetése felvételre került. Automatikusan visszairányítjuk a kezdőoldalra.";
	} else{
		echo "HIBA: Could not able to execute $sql. " . $mysqli->error;
	}
	 
	$mysqli->close();
	
	
	header( "refresh:5;url=welcome.php" );

?>