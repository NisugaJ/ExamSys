<?php
    session_start();
  	if(!isset($_SESSION["s_id"]) && !isset($_SESSION["ExamID"])  ) 
    { header('location: Login.php');}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>
Quiz Enter
</title>
<link rel = "stylesheet" href="../CSS/Home.css" type="text/css">
<link rel = "stylesheet" href="../CSS/Quizenter.css" type="text/css">
 
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
</header>

<body background="../images/light-color-background-images-for-websites-4.jpg" >
<div align="center">
	<br/>
	<h1 style="font-size:250%;color:#283AFF">Examination<br/><?php echo $_SESSION["Exam_Name"]; ?></h1>
	</div>
	<div style="font-size:120%">
	<p align="center">Only 1 Attempt is allowed.</p>
	<p align="center">To attempt,type the Quiz password</p>
	<p align="center">below</p>
	</div>
	<br/>
	<p align="center">Duration:<?php echo $_SESSION["Exam_duration"]; ?> minutes</p>
	<div align="center">
	<div style="align:center"> 
	<form method="post" action="Quiz Enter.php">
	<input type="password" name="ExamPass" placeholder="Enter quiz password here" size="21">
	</div>
	<br>
<input type="submit" class="start" name="PWDsubmit" value="Start" />
	<br/>
	<p style= "align:center;font-size:100%">
		*If the quiz password is not working</p>
	<p style= "align:center;font-size:100%;">
		please contact your teacher or</p>
	<p style= "align:center;font-size:100%;">
		instructor.</p>
	
	<?php
	if(isset($_POST["ExamPass"]))

		if( $_SESSION["ExamPWD"] === $_POST["ExamPass"] )
		{
			$_SESSION["current_tot"] = 0; 
			$_SESSION["once_correct"]= 0;
			header("location: OngoingTest.php?q=1");

		}
		else
		{ echo "<h3>The entered Password is INVALID with the Exam</h3>";
			
			?>
			<script>    
			if(typeof window.history.pushState == 'function') 
			{
				window.history.pushState({}, "Hide", "http://localhost:81/Mr.MCQ/pages/Quiz Enter.php");
			}
			</script>
			<?php
		}
	


?>
</div>	
</body>
<footer>

<a align="center"  href="AboutUs.htm">About Us |</a>
<a href="SupportUs.htm">Support |</a>
<a href="PrivacyPolicy.htm">Privacy Policy</a>

<p id="footer" align="center" style="font-size:15px">Mr.MCQ	|	All Rights Reserved</p>
</footer>
</html>