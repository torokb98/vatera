 <?php
	session_start();

	require_once "config.php";

	$nev = $mysqli->real_escape_string($_REQUEST['nev']);
	$kategoria = $mysqli->real_escape_string($_REQUEST['kategoria']);
	$licit = $mysqli->real_escape_string($_REQUEST['licit']);
	$vege = $mysqli->real_escape_string($_REQUEST['aukcio_vege']);
	$aukcio_vege = str_replace("T", " ", $vege);
	$leiras = $mysqli->real_escape_string($_REQUEST['leiras']);	
	//$pic1 = $mysqli->real_escape_string($_REQUEST['pic1']);
	//$pic2 = $mysqli->real_escape_string($_REQUEST['pic2']);
	//$pic3 = $mysqli->real_escape_string($_REQUEST['pic3']);
	$uname = htmlspecialchars($_SESSION["username"]);
	
	/*echo $nev."<br>";
	echo $kategoria."<br>";
	echo $licit."<br>";
	echo $leiras."<br>";*/

	$file_name1 = $_FILES['pic1']['name'];
	$file_tmp1 = $_FILES['pic1']['tmp_name'];
	move_uploaded_file($file_tmp1,"kepek\\".$file_name1);
	
	$file_name2 = $_FILES['pic2']['name'];
	$file_tmp2 = $_FILES['pic2']['tmp_name'];
	move_uploaded_file($file_tmp2,"kepek\\".$file_name2);
	
	$file_name3 = $_FILES['pic3']['name'];
	$file_tmp3 = $_FILES['pic3']['tmp_name'];
	move_uploaded_file($file_tmp3,"kepek\\".$file_name3);
	
	if($kategoria=="Kérjük válasszon" || $kategoria=="x")
	{
		echo "Nem választott kategóriát! Visszairányítjuk az előző oldalra.";
		header( "refresh:5;url=new-auction.php" );
	}
	
	else{
	$sql = "INSERT INTO termekek (nev, kategoria, kezdo_licit, aktualis_licit, aukcio_vege, kep1, kep2, kep3, leiras, username) VALUES ('$nev', '$kategoria', '$licit', '$licit', '$aukcio_vege', '$file_name1', '$file_name2', '$file_name3', '$leiras', '$uname')";
	if($mysqli->query($sql) === true){
		echo "A hirdetése felvételre került. Automatikusan visszairányítjuk a kezdőoldalra.";
	} else{
		echo "HIBA: Could not able to execute $sql. " . $mysqli->error;
	}
	
		$mysqli->close();
	
	
	header( "refresh:5;url=welcome.php" );
	
	}
	
	 


?>