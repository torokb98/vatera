 <?php
	session_start();

	require_once "config.php";

	$id = $_GET['id'];
	$my_username = $_SESSION["username"];

	
	$sql = "DELETE FROM kedvencek WHERE termek_id='$id' AND username='$my_username'";
	if($mysqli->query($sql) === true){
		echo "Sikeresen eltávolítva a kedvencek közül! Automatikusan visszairányítjuk az előző oldalra.";
	} else{
		echo "HIBA: Could not able to execute $sql. " . $mysqli->error;
	}
	
	 
	$mysqli->close();
	
	
	header( "refresh:5;url=auction.php?id=".$id );

?>