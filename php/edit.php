 <?php
	session_start();

	require_once "config.php";

	$id = $_GET['id'];
	
	$nev = $mysqli->real_escape_string($_REQUEST['nev']);
	$kategoria = $mysqli->real_escape_string($_REQUEST['kategoria']);
	$vege = $mysqli->real_escape_string($_REQUEST['aukcio_vege']);
	$aukcio_vege = str_replace("T", " ", $vege);
	$leiras = $mysqli->real_escape_string($_REQUEST['leiras']);	

	
	/*$file_name1 = $_FILES['pic1']['name'];
	$file_tmp1 = $_FILES['pic1']['tmp_name'];
	move_uploaded_file($file_tmp1,"kepek\\".$file_name1);
	
	$file_name2 = $_FILES['pic2']['name'];
	$file_tmp2 = $_FILES['pic2']['tmp_name'];
	move_uploaded_file($file_tmp2,"kepek\\".$file_name2);
	
	$file_name3 = $_FILES['pic3']['name'];
	$file_tmp3 = $_FILES['pic3']['tmp_name'];
	move_uploaded_file($file_tmp3,"kepek\\".$file_name3);*/
	
	
	$sql = "UPDATE termekek SET nev='$nev', kategoria='$kategoria', aukcio_vege='$aukcio_vege', leiras='$leiras' WHERE id=$id";
	if($mysqli->query($sql) === true){
		echo "A hirdetése módosítása megtörtént. Automatikusan visszairányítjuk a hirdetéseihez.";
	} else{
		echo "HIBA: Could not able to execute $sql. " . $mysqli->error;
	}
	
	 
	$mysqli->close();
	
	
	header( "refresh:5;url=my-auctions.php" );

?>