<?php require'config.php'; 
		session_start();
		if(!isset($_SESSION["t_id"])  )
		{ header('location: Login.php');}
		$p_id = $_GET["id"];
		$t_id = $_SESSION["t_id"];
		$paper_type = $_GET["type"];
		$_SESSION["totQuestions"] = $_GET["totQs"];

		?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Edit Paper</title>
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

<?php 
	$ppr_type = $_GET["type"];
?>
	<h2 align="center" >Edit  <?php if( $_GET["type"] == 'e'){echo "Exam";}if( $_GET["type"] == 'm'){echo "Model ";}?>Paper</h2>
	
	<form  method="POST" >
		Paper Name<br><input type="text" name="test_name" value="<?php echo $_GET["name"]; ?>" required><br><br/>
		
         <table cellpadding="10">
         <tr>
             <td> 
             	Select Subject
               <select name="select_sub">
                    <option value="<?php echo $_GET["sub"];?>" ><?php echo $_GET["sub"];?></option>
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
<textarea value="<?php echo $_GET["ins"];?>" rows="4" cols="37" style="font-size:16px" name="Test_Instructions" required><?php echo $_GET["ins"];?></textarea>
		<br/>
		<br/>
   	<!--   	Paper Type<br/><br/>
	<table>
        	<tr>
			<td><input type="radio" value="e" name="paper_type" <?php //if( $_GET["type"] == 'e'){echo "checked";}?> required>Exam Paper</td>
			<td><input type="radio" value="m" name="paper_type" <?php //if( $_GET["type"] == 'm'){echo "checked";}?> required>Model Paper</td>
            </tr>
		</table> -->
        <br/>
		Total Questions<br>
		<input type="number" name="Total_Questions" max="100" min="5" value="<?php echo $_GET["totQs"];?>" required><br/>
		Total Marks <br/>
		<input type="number" name="Total_Marks" max="200" required value="<?php echo $_GET["totM"];?>"> <br/>
        Duration(min)
        <input type="number" name="duration" max="200"  value="<?php echo $_GET["dur"];?>"><br/>
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
	$papername = $_POST["test_name"];
	if(isset($_POST["select_sub"]) )
	{
		$select_subject = $_POST["select_sub"];
	}
	if(isset($_POST["addCategory"]) )
	{
		$add_subject = $_POST["addCategory"];
	}
	
	$Test_Instructions = $_POST["Test_Instructions"];
	
	$Total_Questions = $_POST["Total_Questions"];
	$Total_Marks = $_POST["Total_Marks"];
	$duration = $_POST["duration"];
	
	if( isset($paper_type) && $paper_type == 'e' )
	{
		if( isset($_POST["addCategory"] ) )
		{	
				//$sql = "INSERT INTO exampaper(examPaper_ID, name, subject, examIns, totalQuestions, totalMarks, duration) 
				//		VALUES 	(NULL,'$papername','$add_subject','$Test_Instructions', '$Total_Questions' ,'$Total_Marks', '$duration')";
				$sql = "update `exampaper` 
					set   
						`name` = '$papername',
						`subject` = '$add_subject',
						`examIns` = '$Test_Instructions',
						`totalQuestions` = '$Total_Questions',
						`totalMarks` = $Total_Marks,
						`duration` = $duration
						WHERE `examPaper_ID` =  '$p_id' ;" ;
				$result = mysqli_query( $conn, $sql );
		}
		else
		{
				//$sql = "INSERT INTO exampaper(examPaper_ID, name, subject, examIns, totalQuestions, totalMarks, duration) 
				//		VALUES 	(NULL,'$papername','$select_subject', '$Test_Instructions', '$Total_Questions' ,'$Total_Marks', '$duration')";
				$sql = "update `exampaper` 
				set   
					`name` = '$papername',
					`subject` = '$select_subject',
					`examIns` = '$Test_Instructions',
					`totalQuestions` = '$Total_Questions',
					`totalMarks` = $Total_Marks,
					`duration` = $duration
					WHERE `examPaper_ID` =  '$p_id' ;" ;
	
				$result = mysqli_query( $conn, $sql );
		}
	}
	else if( isset($paper_type) && $paper_type == 'm' )
	{
				if( isset($_POST["addCategory"] ) )
		{	
				//$sql = "INSERT INTO modelpaper(modelPaper_ID, name, subject, modelPaperIns, totalQuestions, totalMarks,  duration) VALUES 	(
				   //		NULL,'$papername','$add_subject','$Test_Instructions', '$Total_Questions' ,'$Total_Marks',  '$duration')";
				   $sql = "update `modelpaper` 
				   set   
					   `name` = '$papername',
					   `subject` = '$add_subject',
					   `modelPaperIns` = '$Test_Instructions',
					   `totalQuestions` = '$Total_Questions',
					   `totalMarks` = $Total_Marks,
					   `duration` = $duration
					   WHERE `modelPaper_ID` =  '$p_id';" ;
				$result = mysqli_query( $conn, $sql );
		}
		else
		{
				//$sql = "INSERT INTO modelpaper(modelPaper_ID, name, subject, modelPaperIns, totalQuestions, totalMarks,  duration) VALUES 
				//		 (NULL,'$papername','$select_subject', '$Test_Instructions', '$Total_Questions' ,'$Total_Marks',  '$duration')";
				$sql = "update `modelpaper` 
				set   
					`name` = '$papername',
					`subject` = '$select_subject',
					`modelPaperIns` = '$Test_Instructions',
					`totalQuestions` = '$Total_Questions',
					`totalMarks` = $Total_Marks,
					`duration` = $duration
					WHERE `modelPaper_ID` =  '$p_id' ;" ;
				$result = mysqli_query( $conn, $sql );
		}
	
	}
	if($result)
	{
		echo '<h2 align="center">Updated Successfully</h2>';
		$_SESSION["p_id"] = $p_id;
		if(isset($add_subject))
		{header('location: CreateQuiz.php?id='.$p_id.'&type='.$ppr_type.'&name='.$papername.'&totQs='.$Total_Questions.'&totM='.$Total_Marks.'&dur='.$duration.'&sub='.$add_subject.'&ins='.$Test_Instructions.'');}
		else{header('location: CreateQuiz.php?id='.$p_id.'&type='.$ppr_type.'&name='.$papername.'&totQs='.$Total_Questions.'&totM='.$Total_Marks.'&dur='.$duration.'&sub='.$select_subject.'&ins='.$Test_Instructions.'');}

	}
	else
	{
		$conn->error;
	}
}	

mysqli_close($conn);
