<?php   session_start();
		require'config.php';

  	if(!isset($_SESSION["t_id"]) ) 
    { header('location: Login.php');}

 ?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel = "stylesheet" href="../CSS/Home.css" type="text/css">
<link rel = "stylesheet" href="../CSS/Taccount.css" type="text/css">
<style>
#table_type
{
	
    font-family: arial, sans-serif;
   	border-collapse: collapse;
    width: 50%;
	border: 3px solid black;
}
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
<title>
	User Account(Teacher)
</title>
</head>

<header>
<ul id="menubar">
<div id="menu">
<li class="button_logo" ><a href="Home.php" id="logo">Mr.MCQ</a></li>
<li class="button"><a href="Home.php">Home</a></li>
<li class="button"><a href="Pastpapers.php">Model Papers</a></li>
<li class="button"><a href="Help.php">Help</a></li>
<li class="button"><a href="ContactUs.php">Contact us</a></li>
</div>
<div id="account">
<li class="button" id="account_button"><a href="UserAccount(Teacher).php" >Account <img src="../images/profile_icon.jpg" height="15px" width="15px"></a></li>
<li class="button"><a href="Logout.php" >Logout</a></li>
</div>
</ul>
</header>

<body background="../images/light-color-background-images-for-websites-4.jpg">
<br/>
<div align="center">
<br/><br/>
<label><b> Teacher</b></label><br/><br/>
Name:<label><?php echo $_SESSION["firstname"]." ".$_SESSION["lastname"];?> </label><br/>
Username       :<label> <?php echo $_SESSION["username"]; ?> </label><br>
Email       :<label> <?php echo $_SESSION["email"]; ?> </label><br>
<br/><br/>

<form action="CreateTest.php"><input type="submit" id="CreatePaper" name="CreatePaper" value="Create A Paper" /></form>

<br/>
<table id="table_type">
<form method="post">
<th><button name="exam_paper">Exam Papers</button></th>
<th><button name="exam">Examinations</button></th>
<th><button name="model_paper">Model Papers</button></th>

</form>

</table>
<br/>
<table>
<?php 
	$Tid = $_SESSION["t_id"];
	if ( isset($_POST["exam"] )   )
	{
		$sql = "select * from examination where teacher_ID ='$Tid' ";
		$result = mysqli_query($conn, $sql);
		if( mysqli_num_rows($result) > 0 )
		{
			?>
			<th>Exam ID</th>
			<th>Exam Name</th>
            <th>Exam Paper ID</th>
            <th>Expiry Date</th>
            <th>Expiry Time</th>
            <th>Duration</th>
           
        	
			<?php
			while( $row = mysqli_fetch_array($result) )
			{
				?>
                <tr>
				<td><?php echo $row["exam_ID"]; ?></td>
				<td><?php echo $row["Exam_Name"]; ?></td>
                <td><?php echo $row["examPaper_ID"]; ?></td>
                <td><?php echo $row["examExpiryDate"]; ?></td>
                <td><?php echo $row["examExpiryTime"]; ?></td>
                <td><?php echo $row["duration"]; ?></td>
                <?php echo '<td><a href="results page table.php?id='.$row['exam_ID'].'">Results</a> </td>' ?>
                <?php echo '<td><a name="del_'.$row['exam_ID'].'" href="UserAccount(Teacher).php?id='.$row['exam_ID'].'">Delete</a> </td>' ?>
                </tr>
				<?php
			}
		}
		if( isset($_GET["id"] ))
		{
			$del_exm_id = $_GET["id"] ;
			$sql ="delete from examination where exam_ID = '$del_exm_id' ";			
			$result = mysqli_query($conn, $sql);
			if($result)
			{
				echo'<h3 style="color:red"> Successfully Deleted</h3>';	
				?>
                <script>    
				if(typeof window.history.pushState == 'function') 
				{
					window.history.pushState({}, "Hide", "http://localhost:81/Mr.MCQ/pages/UserAccount(Teacher).php");
				}
				</script>
                <?php
			}
		}
		
		
	}
?>
<?php 
	$Tid = $_SESSION["t_id"];
	if ( isset($_POST["exam_paper"] )   )
	{
		$type = "e";
		$sql = "select * from exampaper where teacher_ID ='$Tid' ";
		$result = mysqli_query($conn, $sql);
		if( mysqli_num_rows($result) > 0 )
		{
			?>
            <th>Exam Paper ID</th>
            <th>Exam Paper Name</th>
            <th>Subject</th>
            <th>Total Questions</th>
            <th>TotalMarks</th>
            <th>Duration</th>
        	
				<?php
				while( $row = mysqli_fetch_array($result) )
				{
				?>
                <tr>
				<td><?php echo $row["examPaper_ID"]; ?></td>
                <td><?php echo $row["name"]; ?></td>
                <td><?php echo $row["subject"]; ?></td>
                <td><?php echo $row["totalQuestions"]; ?></td>
                <td><?php echo $row["totalMarks"]; ?></td>
                <td><?php echo $row["duration"]; ?></td>
				<?php echo '<td><a href="ConductExam.php?id='.$row['examPaper_ID'].'&type='.$type.'&name='.$row['name'].'&totQs='.$row['totalQuestions'].'&totM='.$row['totalMarks'].'&dur='.$row['duration'].'&sub='.$row['subject'].'&ins='.$row['examIns'].'" >Conduct Exam</a> </td>' ?>
                <?php echo '<td><a href="EditTest.php?id='.$row['examPaper_ID'].'&type='.$type.'&name='.$row['name'].'&totQs='.$row['totalQuestions'].'&totM='.$row['totalMarks'].'&dur='.$row['duration'].'&sub='.$row['subject'].'&ins='.$row['examIns'].'" >Edit</a> </td>' ?>
                <?php echo '<td><a name="del_'.$row['examPaper_ID'].'" href="UserAccount(Teacher).php?id='.$row['examPaper_ID'].'">Delete</a> </td>' ?>
                </tr>
				<?php
			}
		}
		if( isset($_GET["id"] ) )
		{
			$del_exmppr_id = $_GET["id"];
			$sql ="delete from exampaper where examPaper_ID = '$del_exmppr_id' ";			
			$result = mysqli_query($conn, $sql);
			if($result)
			{
				echo'<h3 style="color:red"> Successfully Deleted</h3>';	
				?>
                <script>    
				if(typeof window.history.pushState == 'function') 
				{
					window.history.pushState({}, "Hide", "http://localhost:81/Mr.MCQ/pages/UserAccount(Teacher).php");
				}
				</script>
                <?php
			}
		}
		
		
	}
?>
<?php 
	$Tid = $_SESSION["t_id"];
	if ( isset($_POST["model_paper"] )   )
	{
		$type = "m";
		$sql = "select * from modelpaper where teacher_ID ='$Tid' ";
		$result = mysqli_query($conn, $sql);
		if( mysqli_num_rows($result) > 0 )
		{
			?>
            <th>Model Paper ID</th>
            <th>Model Paper Name</th>
            <th>Subject</th>
            <th>Total Questions</th>
            <th>TotalMarks</th>
            <th>Duration</th>
        	
				<?php
				while( $row = mysqli_fetch_array($result) )
				{
				?>
                <tr>
				<td><?php echo $row["modelPaper_ID"]; ?></td>
                <td><?php echo $row["name"]; ?></td>
                <td><?php echo $row["subject"]; ?></td>
                <td><?php echo $row["totalQuestions"]; ?></td>
                <td><?php echo $row["totalMarks"]; ?></td>
                <td><?php echo $row["duration"]; ?></td>
                <?php echo '<td><a href="EditTest.php?id='.$row['modelPaper_ID'].'&type='.$type.'&name='.$row['name'].'&totQs='.$row['totalQuestions'].'&totM='.$row['totalMarks'].'&dur='.$row['duration'].'&sub='.$row['subject'].'&ins='.$row['modelPaperIns'].'" >Edit</a> </td>' ?>
                <?php echo '<td><a name="del_'.$row['modelPaper_ID'].'" href="UserAccount(Teacher).php?id='.$row['modelPaper_ID'].'">Delete</a> </td>' ?>
                </tr>
				<?php
			}
		}
		if( isset($_GET["id"] ))
		{
			$del_mdlppr_id = $_GET["id"];
			$sql ="delete from modelpaper where modelPaper_ID = '$del_mdlppr_id' ";			
			$result = mysqli_query($conn, $sql);
			if($result)
			{
				echo'<h3 style="color:red"> Successfully Deleted</h3>';	
				?>
                <script>    
				if(typeof window.history.pushState == 'function') 
				{
					window.history.pushState({}, "Hide", "http://localhost:81/Mr.MCQ/pages/UserAccount(Teacher).php");
				}
				</script>
                <?php
			}
		}		
	}
?>
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