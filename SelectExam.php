<?php
    session_start();
  	if(!isset($_SESSION["t_id"]) || !isset($_SESSION["s_id"]) ) 
    { header('location: Login.php');}
?><!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Exam Paper</title>
    <link rel = "stylesheet" href="../CSS/Home.css" type="text/css">
    <link rel = "stylesheet" href="../CSS/SelectExam.css" type="text/css">
</head>

<header>
<ul id="menubar">
<div id="menu">
<li class="button_logo" ><a href="Home.php" id="logo">Mr.MCQ</a></li>
<li class="button"><a href="Home.php">Home</a></li>
<li class="button"><a href="Pastpapers.php">Past papers</a></li>
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
</header><body background="../images/light-color-background-images-for-websites-4.jpg" >
<br/>
<h2 name="papername" align="center"></h2>

<div align="center" id="select">
<table cellspacing="100px" >
<tr>
<td  ><button id="VEP">View/Edit Paper</button> </td>
 <td><button id="CExam">Conduct Exam</td>
 </tr>
 </table>
</div>

</body>

<footer>

<a align="center"  href="AboutUs.htm">About Us |</a>
<a href="SupportUs.htm">Support |</a>
<a href="PrivacyPolicy.htm">Privacy Policy</a>

<p id="footer" align="center" style="font-size:15px">Mr.MCQ	|	All Rights Reserved</p>
</footer>
</html>