<?php 	
    require'config.php';
session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel = "stylesheet" href="../CSS/Home.css" type="text/css">
<!-- <link rel = "stylesheet" href="../CSS/Help.css" type="text/css"> -->
<title>
	Help
</title>
<style>
table 
{
	
    font-family: arial, sans-serif;
   	border-collapse: collapse;
    width: 100%;
	border: 3px solid black;
}

 th {
   border: 3px solid black;
    text-align: center;
    padding: 8px;
	background-color: #85C1E9;
}
td {
    padding: 20px;
    text-align: center;
	border: 3px solid black;
	}
tr:nth-child(even) {
    background-color: #dddddd;
}
</style>
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
</header>s
<body background="../images/light-color-background-images-for-websites-4.jpg" >
<br/>
<br/>
<div id="help" align="center" >
<h2 align="center">HOW CAN I HELP YOU ?</h2>

	<input type="text" placeholder="Search"  name="Help_Search" > 
</div>

<h3 ><u>What is Mr.MCQ?</u></h3>

<p align="center">Mr.MCQ is an Online Examination System which enables teachers to create and conduct tests with multiple choice questions.  Teachers and students are provided an interactive platform for convenience.</p>

<h4><b>FAQ</b></h4>
<table>
<th>Qustion</th>
<th>Answer</th>
<?php

$sql = "SELECT que,answer  FROM contact_us";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {

	echo"<tr>";
	?> <td> <?php echo $row["que"]; ?> </td> 
	 <td> <?php echo $row["answer"]; ?> </td> <?php
	 echo"</tr>";
}




?>
<ul>
<li><b>How to sign up as a teacher ?</b></li>
<ol>
<li>Go to the registration page.</li>
<li>Fill out the registration form.</li>
<li>Select the <q>I'm a teacher</q> button.</li>
<li>Select the <q>Register</q> button.</li>
</ol>
<li><b>How to register as a student ?</b></li>
<ol>
<li>Go to the registration page.</li>
<li>Fill out the registration form.</li>
<li>Select the <q>I'm a student</q> button.</li>
<li>Select the <q>Register</q> button.</li>
</ol>
<li><b>How to enter an online exam ?</b></li>
<ol>
<li>Go to register or Log in page.</li>
<li>Go to Your Account Page</li>
<li>Select the relevant exam</li>
<li>Enter quiz password and Start the exam</li>
</ol>
</ul>
</body>

<footer>

<a align="center" href="AboutUs.htm">About Us |</a>
<a href="SupportUs.htm">Support |</a>
<a href="PrivacyPolicy.htm">Privacy Policy</a>

<p id="footer" align="center" style="font-size:15px">Mr.MCQ	|	All Rights Reserved</p>
</footer>
</html>

<?php $conn->close(); ?>