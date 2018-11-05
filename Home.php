<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel = "stylesheet" href="../CSS/Home.css" type="text/css">
<title>
Mr.MCQ
</title>
</head>
<header>
<ul id="menubar">

<div id="menu">
<li class="button_logo" ><a href="Home.php" id="logo">Mr.MCQ</a></li>
<li class="button"><a href="Home.php">Home</a></li>
<li class="button"><a href="Pastpapers.php">Model papers</a></li>
<li class="button"><a href="Help.php">Help</a></li>
<li class="button"><a href="ContactUs.php">Contact us</a></li>
</div>
<div id="account">
<?php if(isset($_SESSION["t_id"]) )
{
	?>
<li class="button" id="account_button"><a href="UserAccount(Teacher).php" >Account <img src="../images/profile_icon.jpg" height="15px" width="15px"></a></li>
<li class="button"><a href="Logout.php" >Logout</a></li>

<?php } 

elseif(isset($_SESSION["s_id"] )) {?>
<li class="button" id="account_button"><a href="UserAccount(Student).php" >Account <img src="../images/profile_icon.jpg" height="15px" width="15px"></a></li>
<li class="button"><a href="Logout.php" >Logout</a></li>
<?php } 
else {?>
<li class="button"><a href="Register.htm" >Register</a></li>
<li class="button"><a href="Login.php" >Login</a></li>
<?php } ?>
</div>
</ul>
</header></br></br>
<body background="../images/sky-blue-painted-wall-texture-photograph-photos_2226029.jpg" >
	<div align="center">
	<img src="../images/HOME.jpg" alt="Girl in a jacket" width="80%" height="670" >
	</div>

<h1 align="center">Welcome to Mr.MCQ </h1>
<p align="center">Mr.MCQ is an Online Examination System.<br/> This enables teachers to create and conduct tests with multiple choice questions<br/> Teachers and students are provided an interactive platform for convenience<br/>
  <br/>

<img src="../images/WhatsApp Image 2018-08-08 at 00.12.25.jpeg" height="80%" width="30%" align="justify" ><br/>
Get started today. <a href="Register.htm">Register</a>
 and get an account now. </p> 

</body>
<footer>

<a align="center" href="AboutUs.htm">About Us |</a>
<a href="SupportUs.htm">Support |</a>
<a href="PrivacyPolicy.htm">Privacy Policy</a>

<p id="footer" align="center" style="font-size:15px">Mr.MCQ	|	All Rights Reserved</p>
</footer>

</html>
