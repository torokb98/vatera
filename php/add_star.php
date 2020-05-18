 <?php
	session_start();

	require_once "config.php";

	$id = $_GET['id'];
	$username = $_SESSION["username"];

	
	$sql = "INSERT INTO kedvencek (termek_id, username) VALUES ('$id', '$username')";
	if($mysqli->query($sql) === true){
		echo "Sikeresen hozzáadva a kedvencekhez! Automatikusan visszairányítjuk az előző oldalra.";
	} else{
		echo "HIBA: Could not able to execute $sql. " . $mysqli->error;
	}
	
	 
	$mysqli->close();
	
	
	header( "refresh:5;url=auction.php?id=".$id );

?>