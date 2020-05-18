 <?php
	session_start();

	require_once "config.php";

	$id = $_GET['id'];
	$uj_licit = $mysqli->real_escape_string($_REQUEST['uj_licit']);
	$nyertes_user = $_SESSION["username"];

	
	$sql = "UPDATE termekek SET aktualis_licit='$uj_licit', nyertes_user='$nyertes_user' WHERE id = '$id'";
	if($mysqli->query($sql) === true){
		echo "Sikeres licit! Automatikusan visszairányítjuk az előző oldalra.";
	} else{
		echo "HIBA: Could not able to execute $sql. " . $mysqli->error;
	}
	
	 
	$mysqli->close();
	
	
	header( "refresh:5;url=auction.php?id=".$id );

?>