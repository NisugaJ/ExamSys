<br/>
 <?php 
	require('config.php');
	session_start();

	if(!isset($_SESSION["s_id"])  )
	{ header('location: Login.php');
	}
	 
	
	// if(isset($_GET["Save_Paper"]))
	//  { 
	// 	 $live_marks = $_SESSION["current_tot"];
	// 	 $totMarks = $_SESSION["totalMarks"];
	// 	 if($live_marks > ($totMarks * 75 / 100) )
	// 	 {
	// 			$grade = 'A';
	// 	 }
	// 	 elseif($live_marks > ($totMarks * 65 / 100))
	// 	 {
	// 		$grade = 'B';
	// 	  }	
	// 	  elseif($live_marks > ($totMarks * 55 / 100))
	// 	  {
	// 		 $grade = 'C';
	// 	  }		
	// 	   else{  $grade = 'F'; }

	// 	 $examName = $_SESSION["examName"];
	// 	 $tch_id = $_SESSION["teacher_ID"];
	// 	 $exam_ID = $_SESSION["ExamID"];
	// 	 $s_ID = $_SESSION["s_id"];
	// 	 $result_insert = "insert into `result`(Exam, Result,student_ID , exam_ID, Grade,T_ID) values('$examName', $live_marks,$s_ID,$exam_ID, '$grade', $tch_id) ";
	// 	 $result_result_insert = mysqli_query($conn, $result_insert);
	// 	 if(!$result_result_insert)
	// 	 	{
	// 			 echo $conn->error;
	// 		 }
	// 	else{
	
	// 	  header('location: UserAccount(Teacher).php');
	// 	}
	// }
	/*<td><?php echo $row["modelPaper_ID"]; ?></td>
	<td><?php echo $row["name"]; ?></td>
	<td><?php echo $row["subject"]; ?></td>
	<td><?php echo $row["totalQuestions"]; ?></td>
	<td><?php echo $row["totalMarks"]; ?></td>
	<td><?php echo $row["duration"]; ?></td>*/

	if(isset($_GET["modelPaper_ID"]) ){$paper_ID = $_GET["modelPaper_ID"];}

	if(isset($_GET["name"]) ){$paper_name = $_GET["name"];}

	if(isset($_GET["totalQuestions"]) ){ $totQuestions = $_GET["totalQuestions"];}

	if(isset($_GET["totalMarks"]) ){  $totMarks = $_GET["totalMarks"];}
	
	if(isset($_GET["duration"]) ){   $duration = $_GET["duration"];}

	if(!isset($_GET["q"])){ $_GET["q"] = 1;}
	$q = $_GET["q"];
	// if($_SESSION["current_tot"] == $totMarks || $q == $totQuestions)
	// {
	// 	header("location: OngoingTest.php");
	// }

	if( isset($_GET["q"]) )
	{
	
		$sql_select = "select * from `exampaperq&a` where `examPaper_ID` = $paper_ID AND `question_ID` = $q; "; 
		$result_select = mysqli_query($conn, $sql_select);
		if( $result_select	)
		{
			while( $row = mysqli_fetch_assoc($result_select) )
			{
				$question = $row["question"];
				$ans1 = $row["selectableAns1"];
				$ans2 = $row["selectableAns2"];
				$ans3 = $row["selectableAns3"];
				$ans4 = $row["selectableAns4"];
				$correctAns = $row["correctAns"];
				$mark = $row["score"];
			}
		}
		else{ echo "Error<br/>". $conn->error;}	

		if($q < $totQuestions ){ $q++;}
		header("location: OngoingTestM.php?q=$q");

	}



	?>
 <!DOCTYPE html>
<html>
<head>
<meta HTTP-EQUIV="Pragma" content="no-cache">
<meta HTTP-EQUIV="Expires" content="-1" >
<link rel = "stylesheet" href="../CSS/Home.css" type="text/css">
<link rel = "stylesheet" href="../CSS/CreateQuiz.css" type="text/css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Live Exam</title>
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
<body background="../images/light-color-background-images-for-websites-4.jpg"  ><br/>
<h3 align="center" > <?php echo $paper_name." - ";  ?> ModelPaper</h3>
<h5><?php echo $_SESSION["current_tot"] ?>
<br/>
<form method="POST">
<br/>
	<?php if(isset($_GET['q'] ) )	{?>
	<b><?php echo $_GET['q']; $q_num =  $_GET['q'];}?></b><br/>
	<textarea readonly  name="question" placeholder="Type Question No.<?php if(isset($_GET['q'] ) )	{echo $_GET['q']; }?>" rows="10" style="font-size:16px" value="<?php if(isset($question)) {echo $question;}?>" required>
	<?php if(isset($question)) {echo $question;}?>
	</textarea><br/><br/>
	<input name="q" value="<?php $q_num; ?>" hidden/><br/>
	<input type="radio" name="sAns" value="1" <?php if(isset($prevoius_S_ANS)) {if($prevoius_S_ANS == 1){ echo "checked";}}?>> <p name="a1" ><?php if(isset($ans1)) {echo $ans1;}?> </p><br>
	<input type="radio" name="sAns" value="2" <?php if(isset($prevoius_S_ANS)) {if($prevoius_S_ANS == 2){ echo "checked";}}?>> <p name="a2" ><?php if(isset($ans2)) {echo $ans2;}?> </p><br>
	<input type="radio" name="sAns" value="3" <?php if(isset($prevoius_S_ANS)) {if($prevoius_S_ANS == 3){ echo "checked";}}?>> <p name="a3" ><?php if(isset($ans3)) {echo $ans3;}?> </p><br>
	<input type="radio" name="sAns" value="4" <?php if(isset($prevoius_S_ANS)) {if($prevoius_S_ANS == 4){ echo "checked";}}?>> <p name="a4" ><?php if(isset($ans4)) {echo $ans4;}?></p><br>
	<br/>

	<input type="submit" name="next" value="Save/Next" id="subbutton" title="To update questions"/> <br/>

	<p style="color:red;" >Tip........
	Please check the most suitable answer before saving</p>
</form>

<?php 

?>
<div id="info">

	<?php 
	$count_q = 1;
	$q_num =  $_GET['q'];
	while($count_q <=  $totQuestions)
	{
		?>
		<form action="OngoingTestM.php?qNo=<?php echo $count_q ?>">
		<input
		style="	background-color:darksalmon;
					color:white;
					border:0;
					width:50px;
					border-radius:2px;"
		 class="q_num" type="submit" name="q" value="<?php echo $count_q ?> "  >
	<?php 
		if ( $count_q % 5 == 0) { echo "<br/>"; }
		$count_q++;
	}
?>
<br/>
<form action="UserAccount(Student).php" ><input type="submit" id="submit" name="Save_Paper" value="Exit" /></form>

	<p><br/><br/><br/><br/></p>
</div>
</body>
<footer >

<a align="center" href="AboutUs.htm">About Us |</a>
<a href="SupportUs.htm">Support |</a>
<a href="PrivacyPolicy.htm">Privacy Policy</a>

<p id="footer" align="center" style="font-size:15px">Mr.MCQ	|	All Rights Reserved</p>
</footer>
</html>

<script>
</script>
