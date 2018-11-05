<?php
    session_start();
  	if(!isset($_SESSION["t_id"]) || !isset($_SESSION["s_id"]) ) 
    { header('location: Login.php');}
?><!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>
Results
</title>

<link rel = "stylesheet" href="../CSS/RPL.css" type="text/css">

<style>
	
ul {
    list-style-type: none;
    border: 1px solid #555;
    padding: 0;
    width: 150px;
    background-color: #f1f1f1;
	
}

li a {
    display: block;
    color: #000;
    padding: 8px 16px;
    text-decoration: none;
	text-align: left;
	border-bottom: 1px solid #555;
}
</style>
</head>

<header>
<ul id="menubar">
<div id="menu">
<li class="button"><a href="Home.php">Home</a></li>
<li class="button"><a href="Pastpapers.php">Past papers</a></li>
<li class="button"><a href="Help.php">Help</a></li>
<li class="button"><a href="ContactUs.php">Contact us</a></li>
</div>
<div id="account">
<?php if(isset($_SESSION["t_id"]) )
{
	?>
<li class="button"><a href="UserAccount(Teacher).php" >Account</a></li>
<li class="button"><a href="Logout.php" >Logout</a></li>

<?php } 

elseif(isset($_SESSION["s_id"] )) {?>
<li class="button"><a href="UserAccount(Student).php" >Account</a></li>
<li class="button"><a href="Logout.php" >Logout</a></li>
<?php } 
else {?>
<li class="button"><a href="Register.htm" >Register</a></li>
<li class="button"><a href="Login.php" >Login</a></li>
<?php } ?>
</div>
</ul>
</header>
<body background="../images/light-color-background-images-for-websites-4.jpg">
<div align="center">
	<h1 style="font-size:300%;color:#000000">RESULTS</h1>
</div>
	<div align="center">
	<h3>BIOLOGY</h3>
	<ul>
	<li><a href="results page table.html">Lesson 1 - Test</a></li>
	<li><a href="#Lesson 2 - Test">Lesson 2 - Test</a></li>
	<li><a href="#Lesson 3 - Test">Lesson 3 - Test</a></li>
	<li><a href="#Lesson 4 - Test">Lesson 4 - Test</a></li>
  
</ul>
</div>

<div align="center">
	<h3>MATHEMATICS</h3>
	<ul>
	<li><a href="#Lesson 1 - Test">Lesson 1 - Test</a></li>
	<li><a href="#Lesson 2 - Test">Lesson 2 - Test</a></li>
	<li><a href="#Lesson 3 - Test">Lesson 3 - Test</a></li>
	<li><a href="#Lesson 4 - Test">Lesson 4 - Test</a></li>
  
</ul>
</div>

<div align="center">
	<h3>COMMERCE</h3>
	<ul>
	<li><a href="#Lesson 1 - Test">Lesson 1 - Test</a></li>
	<li><a href="#Lesson 2 - Test">Lesson 2 - Test</a></li>
	<li><a href="#Lesson 3 - Test">Lesson 3 - Test</a></li>
	<li><a href="#Lesson 4 - Test">Lesson 4 - Test</a></li>
  
</ul>
</div>

<div align="center">
	<h3>ART</h3>
	<ul>
	<li><a href="#Lesson 1 - Test">Lesson 1 - Test</a></li>
	<li><a href="#Lesson 2 - Test">Lesson 2 - Test</a></li>
	<li><a href="#Lesson 3 - Test">Lesson 3 - Test</a></li>
	<li><a href="#Lesson 4 - Test">Lesson 4 - Test</a></li>
  
</ul>
</div>

</body>

<footer>

<a align="center" href="ContactUs.htm">Contact Us |</a>
<a href="AboutUs.htm">About Us |</a>
<a href="SupportUs.htm">Support |</a>
<a href="PrivacyPolicy.htm">Privacy Policy</a>

<p id="footer" align="center" style="font-size:15px">Mr.MCQ	|	All Rights Reserved</p>
</footer>
</html>