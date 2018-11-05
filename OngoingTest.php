<br/>
 <?php 
	require('config.php');
	session_start();

	if(!isset($_SESSION["s_id"])  )
	{ header('location: Login.php');
	}
	 
	
	if(isset($_GET["Save_Paper"]))
	 { 
		 $live_marks = $_SESSION["current_tot"];
		 $totMarks = $_SESSION["totalMarks"];
		 if($live_marks > ($totMarks * 75 / 100) )
		 {
				$grade = 'A';
		 }
		 elseif($live_marks > ($totMarks * 65 / 100))
		 {
			$grade = 'B';
		  }	
		  elseif($live_marks > ($totMarks * 55 / 100))
		  {
			 $grade = 'C';
		  }	
	
		   else{  $grade = 'F'; }

		 $examName = $_SESSION["examName"];
		 $tch_id = $_SESSION["teacher_ID"];
		 $exam_ID = $_SESSION["ExamID"];
		 $s_ID = $_SESSION["s_id"];
		 $result_insert = "insert into `result`(Exam, Result,student_ID , exam_ID, Grade,T_ID) values('$examName', $live_marks,$s_ID,$exam_ID, '$grade', $tch_id) ";
		 $result_result_insert = mysqli_query($conn, $result_insert);
		 if(!$result_result_insert)
		 	{
				 echo $conn->error;
			 }
		else{
	
		  header('location: UserAccount(Teacher).php');
		}
	 }

	if(isset($_SESSION["examPaper_ID"]) ){$paper_ID = $_SESSION["examPaper_ID"];}

	if(isset($_SESSION["Exam_Name"]) ){$paper_name = $_SESSION["Exam_Name"];}

	if(isset($_SESSION["Exam_totalQuestions"]) ){ $totQuestions = $_SESSION["Exam_totalQuestions"];}

	if(isset($_SESSION["totalMarks"]) ){  $totMarks = $_SESSION["totalMarks"];}
	
	if(isset($_SESSION["Exam_duration"]) ){   $duration = $_SESSION["Exam_duration"];}

	if(!isset($_GET["q"])){ $_GET["q"] = 1;}
	$q = $_GET["q"];
	if($_SESSION["current_tot"] == $totMarks || $q == $totQuestions)
	{
		
		header("location: OngoingTest.php");

	}


	$exam_ID = $_SESSION["ExamID"];
	$examPaper_ID = $_SESSION["examPaper_ID"];
	$s_ID = $_SESSION["s_id"];
	

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
		if(isset($_POST["next"]))
		{
		$sql_select_S_ANS = "select * from `exam_paper_student` where examID = $exam_ID AND examPaperID = $examPaper_ID AND S_ID =$s_ID AND  questionID = $q ";
		$result_mark = mysqli_query($conn, $sql_select_S_ANS);
		if( $result_mark )
		{
			while($row = mysqli_fetch_assoc($result_mark) )
			{
				//$prevoius_S_ANS = $row["student_ans"];
				if( $row["student_ans"]  == $row["correct_ans"]) 
				{
					$_SESSION["current_tot"] += $row["mark"];
					$_SESSION["once_correct"]= 1;
				}
				else
				{
					if($_SESSION["current_tot"] != 0 && $_SESSION["once_correct"]== 1)
					{
						$_SESSION["current_tot"] -= $mark;
						$_SESSION["once_correct"]= 0;
					}
				}
			}
		}
		}
	

	$sql_select_S_ANS = "select * from `exam_paper_student` where examID = $exam_ID AND examPaperID = $examPaper_ID AND S_ID =$s_ID AND  questionID = $q ";
	$result_mark = mysqli_query($conn, $sql_select_S_ANS);
	if( $result_mark )
	{
		while($row = mysqli_fetch_assoc($result_mark) )
		{
			$prevoius_S_ANS = $row["student_ans"];
		}
	}
		
	if(isset($_POST["next"]))
	{
		if(isset($_POST["sAns"]))
		{
			$s_ans = $_POST["sAns"];

			$sql = "insert into `exam_paper_student` VALUES ($exam_ID, $examPaper_ID, $s_ID, $q, $s_ans, $correctAns, $mark ) ";
			$result = mysqli_query($conn, $sql);
			if($result){echo"success";}
			elseif($prevoius_S_ANS != $s_ans)
			{
				
				echo"error";
				$sql = "update `exam_paper_student` set `student_ans` = $s_ans  where examID = $exam_ID AND examPaperID = $examPaper_ID AND S_ID =$s_ID AND  questionID = $q";
				$result = mysqli_query($conn, $sql);
				if($result){echo"success";}
				else{echo"success";}
			}
			if(!($_SESSION["current_tot"] == $totMarks || $q == $totQuestions) )
			{
				if( $correctAns == $_POST["sAns"]) 
				{
					$_SESSION["current_tot"] += $mark;
					
				}
				else {
					if($_SESSION["current_tot"] != 0 && $_SESSION["once_correct"]== 1)
					{
						$_SESSION["current_tot"] -= $mark;
						$_SESSION["once_correct"]= 0;
					}
				}
			}
			/*?>
			<script>
			if ( window.history.replaceState ) {
			  window.history.replaceState( null, null, window.location.href );
			}
			</script>
			<?php*/

		}
		if($q < $totQuestions ){ $q++;}
		header("location: OngoingTest.php?q=$q");

	}

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
<h3 align="center" > <?php echo $paper_name." - ";  ?> Examination</h3>
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
	while($count_q <=  $totQuestions)
	{
		?>
		<form action="OngoingTest.php?qNo=<?php echo $count_q ?>">
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
<form action="UserAccount(Student).php" ><input type="submit" id="submit" name="Save_Paper" value="Finish Attempt" /></form>

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
