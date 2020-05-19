 <?php
	session_start();

	require_once "config.php";

	$id = $_GET['id'];
	
	
	
	$sql = "DELETE FROM termekek WHERE id=$id";
	if($mysqli->query($sql) === true){
		echo "A hirdetése törlése megtörtént. Automatikusan visszairányítjuk a hirdetéseihez.";
	} else{
		echo "HIBA: Could not able to execute $sql. " . $mysqli->error;
	}
	
	 
	$mysqli->close();
	
	
	header( "refresh:5;url=my-auctions.php" );

?>
