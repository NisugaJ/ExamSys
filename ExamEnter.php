<?php     session_start();
	  if(!isset($_SESSION["s_id"]) && !isset($_SESSION["t_id"]) ) 
	  { header('location: Login.php');}
	  ?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>
Enter Exam
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

<body background="../images/light-color-background-images-for-websites-4.jpg" ><br/><br/><br/>
	<div align="center"> 
	<h3 style="color:red"> <?php if(isset($error_ID)) {echo $error_ID;}?></h3>
	<form   method="post" action="ExamEnter.php">
	<input type="text" placeholder="Enter Exam ID below" size="21" name="examID">
	
	<br>
	<input type="submit" id="SubmitExamID" align="center" name="SubmitExamID"  value="Submit ExamID"/>
</form>
	<br/>
	<p style= "align:center;font-size:100%">
		*If the Exam ID is not working</p>
	<p style= "align:center;font-size:100%;">
		please contact your teacher or</p>
	<p style= "align:center;font-size:100%;">
		instructor.</p>
	</div>
	
<?php


	
	if(isset($_POST["SubmitExamID"]))
	{
		$exam_ID = $_POST["examID"];
		require('config.php');
		$sql = "select * from `examination` where `exam_ID` = $exam_ID";

		$result = mysqli_query($conn, $sql);
		if($row = mysqli_fetch_assoc($result) )
		{	
			 $_SESSION["ExamID"] = $_POST["examID"];
			$_SESSION["ExamPWD"] = $row["quizPassword"];
			$_SESSION["examName"] = $row["Exam_Name"];
			$_SESSION["ExamID"] = $row["exam_ID"];
			$_SESSION["examExpiryDate"] = $row["examExpiryDate"];
			$_SESSION["examExpiryTime"] = $row["examExpiryTime"];
			$examPaper_ID = $_SESSION["examPaper_ID"] = $row["examPaper_ID"];
			$_SESSION["duration"] = $row["duration"];

			$sql2 = "select * from `exampaper` where `examPaper_ID` = $examPaper_ID ";
			$result2 = mysqli_query($conn, $sql2);
			if( $row = mysqli_fetch_assoc($result2))
			{
				$_SESSION["Exam_Name"] = $row["name"];
				$_SESSION["Exam_subject"] = $row["subject"];
				$_SESSION["teacher_ID"] = $row["teacher_ID"];
				$_SESSION["Exam_Ins"] = $row["examIns"];
				$_SESSION["Exam_totalQuestions"] = $row["totalQuestions"];
				$_SESSION["totalMarks"] = $row["totalMarks"];
				$_SESSION["Exam_duration"] = $row["duration"];
				
			}
		
			header('location: http://localhost:81/Mr.MCQ/pages/Quiz Enter.php');
		}
		else
		{ echo "<h3>The entered Exam ID is INVALID</h3>";
			
			?>
			<script>    
			if(typeof window.history.pushState == 'function') 
			{
				window.history.pushState({}, "Hide", "http://localhost:81/Mr.MCQ/pages/ExamEnter.php");
			}
			</script>
			<?php
		}

	}
?>
</body>
<footer>

<a align="center"  href="AboutUs.htm">About Us |</a>
<a href="SupportUs.htm">Support |</a>
<a href="PrivacyPolicy.htm">Privacy Policy</a>

<p id="footer" align="center" style="font-size:15px">Mr.MCQ	|	All Rights Reserved</p>
</footer>
</html>

