 <br/>
 <?php 
	require('config.php');
	session_start();

	if( !isset($_SESSION["t_id"]) || !isset($_SESSION["p_id"])  )
	{ header('location: Login.php');}

	if(isset($_GET["totQs"])){ $_SESSION["totQuestions"] = $totQuestions = $_GET["totQs"]; }
	else {if(isset($_SESSION["totQuestions"]) ) { $totQuestions = $_SESSION["totQuestions"];}}

	if(isset($_GET["q"]))
	{
	if(isset($_GET["Save_Paper"]) )
		{ 
			 header('location: UserAccount(Teacher).php');
	 	}
	}

	if(isset($_GET["id"])){$_SESSION["Paper_ID"] =$paper_ID = $_GET["id"];}

	else {if(isset($_SESSION["Paper_ID"]) ){$paper_ID = $_SESSION["Paper_ID"];}}

	if(isset($_GET["name"])) {  $_SESSION["paperName"]= $paper_name = $_GET["name"]; }
	else {if(isset($_SESSION["paperName"]) ){$paper_name = $_SESSION["paperName"];}}

	if(isset($_GET["type"])){ $_SESSION["paperType"] = $paperType = $_GET["type"]; }
	else {if(isset($_SESSION["paperType"]) ){ $paperType = $_SESSION["paperType"];}}

	if(isset($_GET["totQs"])){ $_SESSION["totQuestions"] = $totQuestions = $_GET["totQs"]; }
	else {if(isset($_SESSION["totQuestions"]) ){ $totQuestions = $_SESSION["totQuestions"];}}

	if(isset($_GET["totM"])){ $_SESSION["totMarks"] = $totMarks = $_GET["totM"]; }
	else {if(isset($_SESSION["totMarks"]) ){  $totMarks = $_SESSION["totMarks"];}}
	
	if(isset($_GET["dur"])){ $_SESSION["duration"] = $duration = $_GET["dur"]; }
	else {if(isset($_SESSION["duration"]) ){   $duration = $_SESSION["duration"];}}

	if( !isset($_GET["q"]) ){ $_GET["q"] = 1;}

	if( isset($_GET["q"] ) || isset($_POST["next"]) )
	{
		$q = $_GET["q"];
		if($paperType == 'e'){$sql_select = "select * from `exampaperq&a` where `examPaper_ID` = $paper_ID AND `question_ID` = $q; "; }
		if($paperType == 'm'){$sql_select = "select * from `modelpaperq&a` where `modelPaper_ID` = $paper_ID AND `question_ID` = $q "; }
		
		//header('location: UserAccount(Student).php?qNo=$count_q');
		if( isset($_POST["next"]) ){
			$question_post = $_POST["question"];
			$ans1_post = $_POST["a1"];
			$ans2_post = $_POST["a2"];
			$ans3_post = $_POST["a3"];
			$ans4_post = $_POST["a4"];
			$correctAns_post = $_POST["cAns"];
			$mark_post = $_POST["mark"];
			if($paperType == 'e')
			{
				$sql_insert = "insert into `exampaperq&a` values($paper_ID ,$q, '$question_post', '$ans1_post','$ans2_post', '$ans3_post','$ans4_post', $correctAns_post, $mark_post); ";
				$sql_update = "update `exampaperq&a` 
							set   
								`question` = '$question_post',
								`selectableAns1` = '$ans1_post',
								`selectableAns2` = '$ans2_post',
								`selectableAns3` = '$ans3_post',
								`selectableAns4` = '$ans3_post',
								`correctAns` = $correctAns_post,
								`score` = $mark_post
								WHERE `question_ID` =  '$q' AND `examPaper_ID` = '$paper_ID';" ;
			}
			if($paperType == 'm')
			{
				$sql_insert = "insert into `modelpaperq&a` values($paper_ID ,$q, '$question_post', '$ans1_post','$ans2_post', '$ans3_post','$ans4_post', $correctAns_post, $mark_post); ";
				$sql_update = "update `modelpaperq&a` 
							set 	  
								`question` = '$question_post',
								`selectableAns1` = '$ans1_post',
								`selectableAns2` = '$ans2_post',
								`selectableAns3` = '$ans3_post',
								`selectableAns4` = '$ans3_post',
								`correctAns` = $correctAns_post, 
								`score` = $mark_post
								WHERE `question_ID` = $q AND `modelPaper_ID` = $paper_ID" ;
			}
		}	
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
	}
		
	?>
 <!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> -->
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
<link rel = "stylesheet" href="../CSS/CreateQuiz.css" type="text/css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Create Quiz</title>
	<link rel = "stylesheet" href="../CSS/Home.css" type="text/css">
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
</header>
<body background="../images/light-color-background-images-for-websites-4.jpg"  ><br/>
<br/>
<h3 align="center" > <?php echo $paper_name; if( $paperType == 'e'){echo " - Exam Paper";}if( $paperType == 'm'){echo " - Model Paper";}?></h3>
<br/>
<form method="POST">
<br/>
	<?php if(isset($_GET['q'] ) )	{?>
	<b><?php echo $_GET['q']; $q_num =  $_GET['q'];}?></b><br/>
	<textarea  name="question" placeholder="Type Question No.<?php if(isset($_GET['q'] ) )	{echo $_GET['q']; }?>" rows="10" style="font-size:16px"  required>
	<?php if(isset($question)) {echo $question;}?>
	</textarea><br/><br/>
	<input name="q" value="<?php $q_num; ?>" hidden/><br/>
	<input type="radio" name="cAns" value="1" <?php if(isset($correctAns)) {if($correctAns == 1){ echo "checked";}}?> ><input style="width:100%;" type="text" name="a1" placeholder="Type Answer 1" value="<?php if(isset($ans1)) {echo $ans1;}?>" required><br>
	<input type="radio" name="cAns" value="2" <?php if(isset($correctAns)) {if($correctAns == 2){ echo "checked";}}?>><input  style="width:100%;" type="text" name="a2" placeholder="Type Answer 2" value="<?php if(isset($ans2)) {echo $ans2;}?>" required><br>
	<input type="radio" name="cAns" value="3" <?php if(isset($correctAns)) {if($correctAns == 3){ echo "checked";}}?> ><input style="width:100%;" type="text" name="a3" placeholder="Type Answer 3" value="<?php if(isset($ans3)) {echo $ans3;}?>" required><br>
	<input type="radio" name="cAns" value="4" <?php if(isset($correctAns)) {if($correctAns == 4){ echo "checked";}}?> ><input style="width:100%;" type="text" name="a4" placeholder="Type Answer 4" value="<?php if(isset($ans4)) {echo $ans4;}?>" required><br>
	<br/>
	<p>Assign a mark for this<br> Question</p>
	<input type="text" width="5px" name="mark" value="<?php if(isset($mark)) {echo $mark;} ?>" required/>/<?php echo $totMarks;?>(Total Marks)<br><br>
	<input type="submit" name="next" value="Save" id="subbutton" title="To update questions"/> <br/>

	<p style="color:red;" >Tip........
	Please check the correct answer before saving</p>
</form>
<?php 
if( isset($_POST["next"]) ){
	$result_insert = mysqli_query($conn, $sql_insert);
	if($result_insert)
	{
		echo"Added Successfully";
		$q++;
		header("location: CreateQuiz.php?q=$q");
	}
	else
	{
		echo"Error Ocuured while Inserting <br/>";
		echo $conn->error."<br/>";
		$result_update = mysqli_query($conn, $sql_update);
		if($result_update)
		{		
			echo"Updated Successfully";
			$q++;
			header("location: CreateQuiz.php?q=$q");
		}
		else
		{
			echo"Error Ocuured while upadting<br/>";
			echo $conn->error."<br/>";
		}
	}
}

?>
<div id="info">
	<?php 
	$count_q = 1;
	while($count_q <=  $totQuestions)
	{
		?>
		<form action="CreateQuiz.php?qNo=<?php echo $count_q ?>">
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
<form  ><input type="submit" id="submit" name="Save_Paper" value="Save Paper" /></form>

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
