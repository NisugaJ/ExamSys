<?php require'config.php';
	session_start(); 
	if(!isset($_SESSION["t_id"])  )
	{ header('location: Login.php');}
	
	$teacher_ID = $_SESSION["t_id"];   ?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Create Paper</title>
	<link rel = "stylesheet" href="../CSS/Home.css" type="text/css">
    <link rel = "stylesheet" href="../CSS/Create Test.css" type="text/css">
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
</header><body background="../images/light-color-background-images-for-websites-4.jpg" >
<br/>


	<h2 align="center" >Create Paper</h2>
	
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
		Paper Name<br><input type="text" name="test_name" required><br><br/>
		
         <table cellpadding="10">
         <tr>
             <td> 
             	Select Subject
               <select name="select_sub">
                    <option value="" selected disabled hidden>Choose here</option>
                <?php 
				$sql = "select subject from exampaper";
				$result = mysqli_query($conn, $sql);
				
				if( mysqli_num_rows($result) > 0 )
				{
					while( $row = mysqli_fetch_array($result) )
					{
						?>
						<option><?php echo $row["subject"]; ?></option>
						<?php	
					}
				}	
				$sql = "select subject from modelpaper";
				$result = mysqli_query($conn, $sql);
				
				if( mysqli_num_rows($result) > 0 )
				{
					while( $row = mysqli_fetch_array($result) )
					{
						?>
						<option><?php echo $row["subject"]; ?></option>
						<?php	
					}
				}				
				?>
             </select>
             </td>
        <td>Add Subject
        <input type="text" name="addCategory" /><br/>
        </td>
		</tr>
        </table>
        
		Test Instructions<br>
<textarea placeholder="Test_Instructions" rows="4" cols="37" style="font-size:16px" name="Test_Instructions" required></textarea>
		<br/>
		<br/>
      	Paper Type<br/><br/>
		<table>
        	<tr>
			<td><input type="radio" value="e" name="paper_type" required>Exam Paper</td>
			<td><input type="radio" value="m" name="paper_type" required>Model Paper</td>
            </tr>
		</table>
        <br/>
		Total Questions<br>
		<input type="number" name="Total_Questions" max="100" min="5" required><br/>
		Total Marks <br/>
		<input type="number" name="Total_Marks" max="200" required> <br/>
        Duration(min)
        <input type="number" name="duration" max="200"  ><br/>
		<input type="submit" name="save_PaperDetails" value="Next" >
	</form>
</body>
<footer>

<a align="center"  href="AboutUs.htm">About Us |</a>
<a href="SupportUs.htm">Support |</a>
<a href="PrivacyPolicy.htm">Privacy Policy</a>

<p id="footer" align="center" style="font-size:15px">Mr.MCQ	|	All Rights Reserved</p>
</footer>
</html>

<?php

//echo "Paper Type ".$_POST["paper_type"]."<br/> ";
if( isset($_POST["save_PaperDetails"]) )
{
	//use a session to get Techer_ID
	$_SESSION["paperName"] = $papername = $_POST["test_name"];
	
	if(isset($_POST["select_sub"]) )
	{
		$select_subject = $_POST["select_sub"];
	}
	if(isset($_POST["addCategory"]) )
	{
		$add_subject = $_POST["addCategory"];
	}
	
	$Test_Instructions = $_POST["Test_Instructions"];
	$_SESSION["paperType"] = $paper_type = $_POST["paper_type"];
	$_SESSION["totQuestions"] = $Total_Questions = $_POST["Total_Questions"];
	$_SESSION["totMarks"] = $Total_Marks = $_POST["Total_Marks"];
	$_SESSION["duration"] = $duration = $_POST["duration"];
	
	if( isset($paper_type) && $paper_type == 'e' )
	{
		if( isset($_POST["addCategory"] ) )
		{	
				$sql = "INSERT INTO exampaper(examPaper_ID, name, subject, examIns, totalQuestions, totalMarks, teacher_ID, duration) 
						VALUES 	(NULL,'$papername','$add_subject','$Test_Instructions', '$Total_Questions' ,'$Total_Marks','$teacher_ID',  '$duration')";
				$result = mysqli_query( $conn, $sql );
		}
		else
		{
				$sql = "INSERT INTO exampaper(examPaper_ID, name, subject, examIns, totalQuestions, totalMarks, teacher_ID, duration) 
						VALUES 	(NULL,'$papername','$select_subject', '$Test_Instructions', '$Total_Questions' ,'$Total_Marks','$teacher_ID',  '$duration')";
				$result = mysqli_query( $conn, $sql );
		}
	}
	else if( isset($paper_type) && $paper_type == 'm' )
	{
				if( isset($_POST["addCategory"] ) )
		{	
				$sql = "INSERT INTO modelpaper(modelPaper_ID, name, subject, modelPaperIns, totalQuestions, totalMarks, teacher_ID,  duration) VALUES 	(
      	 				NULL,'$papername','$add_subject','$Test_Instructions', '$Total_Questions' ,'$Total_Marks','$teacher_ID',   '$duration')";
				$result = mysqli_query( $conn, $sql );
		}
		else
		{
				$sql = "INSERT INTO modelpaper(modelPaper_ID, name, subject, modelPaperIns, totalQuestions, totalMarks, teacher_ID,  duration) VALUES 
						 (NULL,'$papername','$select_subject', '$Test_Instructions', '$Total_Questions' ,'$Total_Marks', '$teacher_ID',  '$duration')";
				$result = mysqli_query( $conn, $sql );
		}
	
	}
	if( $result )
	{
		echo '<h2 align="center">Inserted Successfully</h2>';
		if($paper_type == 'e')
		{	
			$sql= "select examPaper_ID from exampaper where name = '$papername' ";
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_array($result);
			$_SESSION["Paper_ID"] = $row["examPaper_ID"]; 
		}
		else if($paper_type == 'm')
		{
			$sql= "select modelPaper_ID from modelpaper where name = '$papername' ";
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_array($result);
			$_SESSION["Paper_ID"] = $row["modelPaper_ID"]; 
		}
		
		header('location: http://localhost:81/Mr.MCQ/pages/CreateQuiz.php');
	}
	else
	{
		$conn->error;
	}
}	

mysqli_close($conn);
?>