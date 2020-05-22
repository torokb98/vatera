 <?php
	session_start();

	require_once "config.php";

	$id = $_GET['id'];
	$my_username = $_SESSION["username"];
	
	$sql = "SELECT kep1, kep2, kep3 FROM termekek WHERE id=$id; ";
	$sql .= "DELETE FROM termekek WHERE id=$id AND username='$my_username'; ";
	if(mysqli_multi_query($mysqli, $sql)){
		do{
			if ($result = mysqli_store_result($mysqli)) {
				
				while ($row = mysqli_fetch_array($result)){
						unlink("kepek\\".$row["kep1"]);
						unlink("kepek\\".$row["kep2"]);
						unlink("kepek\\".$row["kep3"]);
						$result->free();
						echo "A hirdetése törlése megtörtént. Automatikusan visszairányítjuk a hirdetéseihez.";
				}
				
			mysqli_free_result($result);
			}
		}while(mysqli_next_result($mysqli));
	}else{
		echo "HIBA: Could not able to execute $sql. " . $mysqli->error;
	}
	
	 
	$mysqli->close();
	
	
	header( "refresh:5;url=my-auctions.php" );

?>
