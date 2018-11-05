<?php 
	  session_start();
	  require 'config.php';

  	if( !isset($_SESSION["s_id"]) ) 
    { header('location: Login.php');}

?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel = "stylesheet" href="../CSS/Home.css" type="text/css">
<link rel = "stylesheet" href="../CSS/Saccount.css" type="text/css">
<title>
User Account(Student)
</title>
<style>
table 
{
	
    font-family: arial, sans-serif;
   	border-collapse: collapse;
    width: 95%;
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
</head>
<header>
<ul id="menubar">
<li class="button_logo" ><a href="Home.php" id="logo">Mr.MCQ</a></li>
<li class="button"><a href="Home.php">Home</a></li>
<li class="button"><a href="Pastpapers.php">Model Papers</a></li>
<li class="button"><a href="Help.php">Help</a></li>
<li class="button"><a href="ContactUs.php">Contact us</a></li>
</div>
<div id="account">
<li class="button" id="account_button"><a href="UserAccount(Student).php" >Account <img src="../images/profile_icon.jpg" height="15px" width="15px"></a></li>
<li class="button"><a href="Logout.php" >Logout</a></li>
</div>
</ul>
</header>
<body background="../images/light-color-background-images-for-websites-4.jpg"><br/><br/>
<br/>
<div align="center">
<th> Student </th>
<tr>
	   <td>
		Name:<label><?php echo $_SESSION["firstname"]." ".$_SESSION["lastname"];?> </label><br/>
		Username       :<label> <?php echo $_SESSION["username"]; ?> </label><br/>
		Email       :<label> <?php echo $_SESSION["email"]; ?> </label><br/>
	   </td>
</tr>
<tr>
<br/><br/><br/>
<td align="center">
	<a id="enterexam"  href="ExamEnter.php"> Take an Exam</a>
</td>
<br/><br/>
  </tr>
</div>

<div align="center">
 	
<table cellpadding="50px" >
<tr style="font-size:30px" align="center">
	<th>ExamID</th>
	<th>Exam </th>
    <th>Result </th>
	<th>Grade </th>
</tr><br>
<?php
if( isset( $_SESSION["s_id"]) )
{
	$std_id = $_SESSION["s_id"];
	$sql = "select * from result where Student_ID ='$std_id' ";
	$result = mysqli_query($conn, $sql); 

	if(mysqli_num_rows($result) > 0)
	{
		while($row = mysqli_fetch_assoc($result) )
		{
		?>
				<tr align="center">
				<td><?php echo $row["exam_ID"] ?></td>
				<td><?php echo $row["Exam"] ?></td>
				<td><?php echo $row["Result"] ?></td>
				<td><?php echo $row["Grade"] ?></td>
				</tr>
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