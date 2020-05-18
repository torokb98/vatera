 <?php

session_start();
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
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
body{
	  background-image: 
    linear-gradient(
      rgba(0, 0, 0, 0.5),
      rgba(0, 0, 0, 0.5)
    ),url(aszf.jpg);
  background-position: center center;
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
  background-color:#464646;
  
}

</style> 
<head>
	<title>Ászf</title>
</head>
<body style='color:black;margin-left:10px;margin-right:10px;color:white'>
	<h1>Általános Szerződési Feltételek</h1>
	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Gravida neque convallis a cras semper. Ac tincidunt vitae semper quis lectus nulla at. Odio ut sem nulla pharetra diam sit. Nisi scelerisque eu ultrices vitae auctor eu augue. Est ultricies integer quis auctor elit sed vulputate mi. Magna fermentum iaculis eu non diam. Urna duis convallis convallis tellus id interdum velit laoreet id. Tellus rutrum tellus pellentesque eu. Vitae elementum curabitur vitae nunc sed velit dignissim sodales.</p>
	<p>Dui nunc mattis enim ut tellus elementum sagittis vitae. Dis parturient montes nascetur ridiculus mus mauris. Sed vulputate odio ut enim blandit volutpat maecenas. Ornare lectus sit amet est. Libero nunc consequat interdum varius. Egestas tellus rutrum tellus pellentesque eu tincidunt tortor aliquam nulla. Velit ut tortor pretium viverra suspendisse potenti. Aliquam faucibus purus in massa tempor. Nunc vel risus commodo viverra maecenas accumsan lacus. Congue eu consequat ac felis donec et. Vestibulum rhoncus est pellentesque elit.</p>
	<p>Nullam eget felis eget nunc lobortis mattis aliquam. Sapien pellentesque habitant morbi tristique. Turpis tincidunt id aliquet risus. Viverra suspendisse potenti nullam ac tortor vitae. Lacus laoreet non curabitur gravida arcu ac tortor dignissim convallis. Sed augue lacus viverra vitae congue eu consequat ac. Molestie a iaculis at erat pellentesque adipiscing commodo elit. Sit amet commodo nulla facilisi nullam vehicula. Enim nec dui nunc mattis enim ut. Tortor at auctor urna nunc id cursus metus aliquam. Eu augue ut lectus arcu. Feugiat vivamus at augue eget arcu dictum varius duis. Id nibh tortor id aliquet lectus proin nibh nisl. Congue quisque egestas diam in arcu cursus euismod quis viverra. Ullamcorper velit sed ullamcorper morbi. Eget velit aliquet sagittis id consectetur purus. Suspendisse faucibus interdum posuere lorem ipsum dolor sit amet consectetur. Id neque aliquam vestibulum morbi blandit cursus risus. Mauris augue neque gravida in.</p>
	<p>Ipsum nunc aliquet bibendum enim. Tincidunt vitae semper quis lectus nulla at volutpat diam ut. Donec pretium vulputate sapien nec sagittis aliquam. Tempus egestas sed sed risus pretium quam. Quisque non tellus orci ac auctor augue mauris. Amet consectetur adipiscing elit pellentesque habitant morbi tristique senectus et. Volutpat blandit aliquam etiam erat velit scelerisque. Consequat semper viverra nam libero justo laoreet sit amet. Aliquam ultrices sagittis orci a scelerisque purus semper. Elit sed vulputate mi sit amet. Dui accumsan sit amet nulla. In nulla posuere sollicitudin aliquam. Nisl purus in mollis nunc. Aliquam sem et tortor consequat id porta nibh venenatis cras. Congue nisi vitae suscipit tellus mauris. Rhoncus urna neque viverra justo nec ultrices dui sapien. Sed risus pretium quam vulputate. Aliquam nulla facilisi cras fermentum odio.</p>
	<p>Id eu nisl nunc mi ipsum. At ultrices mi tempus imperdiet nulla. Ut lectus arcu bibendum at. Tellus elementum sagittis vitae et leo duis ut diam. Id consectetur purus ut faucibus pulvinar elementum integer enim neque. Nisi quis eleifend quam adipiscing vitae proin sagittis nisl. In iaculis nunc sed augue lacus viverra vitae. Aliquet nec ullamcorper sit amet risus nullam eget. Elit ut aliquam purus sit amet. Amet mauris commodo quis imperdiet. Interdum posuere lorem ipsum dolor sit amet. Aliquet bibendum enim facilisis gravida neque convallis a cras semper. Lectus vestibulum mattis ullamcorper velit sed ullamcorper morbi. Ipsum nunc aliquet bibendum enim facilisis gravida neque. Id velit ut tortor pretium viverra suspendisse potenti nullam. Mauris cursus mattis molestie a iaculis at erat pellentesque adipiscing. Molestie a iaculis at erat pellentesque adipiscing commodo. Dui sapien eget mi proin sed. Odio morbi quis commodo odio aenean sed adipiscing. Gravida arcu ac tortor dignissim convallis.</p>

</body>

</html>