<?php
  require'config.php';
    session_start();
  	if(!isset($_SESSION["t_id"]) && !isset($_SESSION["s_id"]) ) 
    { header('location: Login.php');}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel = "stylesheet" href="../CSS/Taccount.css" type="text/css">
<link rel = "stylesheet" href="../CSS/Home.css" type="text/css">

<style>
#table_type
{
	
    font-family: arial, sans-serif;
   	border-collapse: collapse;
    width: 90%;
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
Model papers
</title>
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
<?php } 
?>
</div>
</ul>
</header> 
<body background="../images/light-color-background-images-for-websites-4.jpg">

<div align="center">
<br/><br/><br/>
<h2>Model Papers</h2>

<table id="table_type">
<?php
$type="m";
$sql = "select * from modelpaper ";
		$result = mysqli_query($conn, $sql);
			?>
        <tr>
            <th>Model Paper ID</th>
            <th>Model Paper Name</th>
            <th>Subject</th>
            <th>Total Questions</th>
            <th>TotalMarks</th>
            <th>Duration</th>
        	</tr>
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
				<?php echo '<td><a href="OngoingTestM.php?id='.$row['modelPaper_ID'].'name='.$row['name'].'totalQuestions='.$row['totalQuestions'].'totalMarks='.$row['totalMarks'].'duration='.$row['duration'].'" >Practice</a> </td>' ?>
          </tr>
        <?php
        }
    ?>
</table>

 </div> 
</body>
<footer>

<a align="center" href="AboutUs.htm">About Us |</a>
<a href="SupportUs.htm">Support |</a>
<a href="PrivacyPolicy.htm">Privacy Policy</a>

<p id="footer" align="center" style="font-size:15px">Mr.MCQ	|	All Rights Reserved</p>
</footer>
</html>