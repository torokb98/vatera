<?php

require_once "config.php";

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty(trim($_POST["username"]))){
        $username_err = "Írjon be egy felhasználónevet";
    } else{

        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = $mysqli->prepare($sql)){

            $stmt->bind_param("s", $param_username);

            $param_username = trim($_POST["username"]);
            
            if($stmt->execute()){
                $stmt->store_result();
                
                if($stmt->num_rows == 1){
                    $username_err = "Ez a felhasználónév már foglalt";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Valami hiba történt. Próbálja meg később";
            }

            $stmt->close();
        }
    }

    if(empty(trim($_POST["password"]))){
        $password_err = "Írjon be jelszót";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "A jelszónak legalább 6 karakter hosszúnak kell lennie";
    } else{
        $password = trim($_POST["password"]);
    }
    
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Erősítse meg a jelszavát";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Jelszavak nem egyeznek";
        }
    }
    
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        

        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
         
        if($stmt = $mysqli->prepare($sql)){

            $stmt->bind_param("ss", $param_username, $param_password);
            
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            
            if($stmt->execute()){
                header("location: login.php");
            } else{
                echo "Valami hiba történt. Próbálja meg később";
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
<body>
<div id="page-container">
<div id="content-wrap">
    <div class="wrapper" align="center">
        <h2 align="center">Regisztrálás</h2>
        <p align="center">Töltse ki a mezőket a regisztráláshoz</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label >Felhasználónév</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Jelszó</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Jelszó megerősítése</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Kész">
                <input type="reset" class="btn btn-default" value="Újra">
            </div>
            <p>Regisztrált már? <a href="login.php">Kattintson ide a bejelentkezéshez! </a></p>
        </form>
    </div>    

<!-- Navbar -->
<div class="w3-top">
  <div class="w3-bar w3-black w3-card w3-left-align w3-large">
    <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-red" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    <a href="login.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Bejelentkezés</a>
	<a href="register.php" class="w3-bar-item w3-button w3-padding-large w3-white">Regisztrálás</a>
  </div>

</div>
<div>
<footer>
	<p>Pannon Egyetem 2020</p>
</footer>
<div>

</body>
</html>