<?php
session_start();
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
 
require_once "config.php";
 
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Írja be az új jelszót";     
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "A jelszónak legalább 6 karakter hosszúnak kell lennie";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Erősítse meg a jelszavát";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Jelszavak nem egyeznek";
        }
    }
        
    if(empty($new_password_err) && empty($confirm_password_err)){
        // Prepare an update statement
        $sql = "UPDATE users SET password = ? WHERE id = ?";
        
        if($stmt = $mysqli->prepare($sql)){
            $stmt->bind_param("si", $param_password, $param_id);
            
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];
            
            if($stmt->execute()){
                session_destroy();
                header("location: login.php");
                exit();
            } else{
                echo "Oops! Valami hiba történt. Próbálja meg később";
            }

            $stmt->close();
        }
    }
    
    $mysqli->close();
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

footer {
  position: absolute;
  bottom: 0;
  width: 100%;
  text-align: center;
  padding: 3px;
  background-color: Black;
  color: white;
}

#page-container {
  position: relative;
  min-height: 100vh;
}

#content-wrap {
  padding-bottom: 2.5rem;    /* Footer height */
}
</style>
<head>
	<title>Welcome</title>
</head>
<body>


	<div class="w3-top">
	  <div class="w3-bar w3-black w3-card w3-center w3-large">
		
		<a href="welcome.php" class="w3-bar-item w3-button w3-padding-large w3-white">Kezdőoldal</a>
		<a href="new-auction.php" class="w3-bar-item w3-button w3-padding-large w3-white">Hirdetesfeladás</a>
		<a href="my-auctions.php" class="w3-bar-item w3-button w3-padding-large w3-white">Hirdetéseim</a>
		<a href="stars.php" class="w3-bar-item w3-button w3-padding-large w3-white">Kedvenceim</a>
		<a href="#" class="w3-bar-item w3-button w3-padding-large w3-black">Új jelszó létrehozása</a>
		<a href="logout.php" class="w3-bar-item w3-button w3-padding-large w3-white">Kijelentkezés</a>
	  </div>

	</div>




<div id="page-container">
<div id="content-wrap">
    <div class="wrapper"  align="center">
        <h2>Jelszó visszaállítása</h2>
        <p>Töltse ki az mezőket új jelszó létrehozásához</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
            <div  class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                <label>Új jelszó</label>
                <input type="password" name="new_password" class="form-control" value="<?php echo $new_password; ?>">
                <span class="help-block"><?php echo $new_password_err; ?></span>
            </div>
            <div style="position:relative;left:-38px"class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Jelszó megerősítése</label>
                <input type="password" name="confirm_password" class="form-control">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Kész">
                <a class="btn btn-link" href="welcome.php" >Vissza</a>
            </div>
        </form>
    </div>  

<div>
<footer>
	<p>Pannon Egyetem 2020</p>
</footer>
<div>
</body>
</html>