<?php
  require'config.php';
    session_start();
  	if(!isset($_SESSION["t_id"])  ) 
    { header('location: Login.php');}

?><!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel = "stylesheet" href="../CSS/Home.css" type="text/css">
<link rel = "stylesheet" href="../CSS/RPT.css" type="text/css">
<style>

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
    text-align: left;
	border: 3px solid black;
	}
tr:nth-child(even) {
    background-color: #dddddd;
}

</style>
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


<body background="../images/light-color-background-images-for-websites-4.jpg">

<h1  align="center" style="color:#05008E">Results</h1>

<table>
  <tr>
 
    <th>Student ID</th>
    <th>Exam</th>
  <th>Result</th>
  <th>Grade</th>
<?php
$T_ID = $_SESSION["t_id"];
$exm_ID = $_GET["id"];
$sql = "SELECT Exam,student_ID,Result, Grade  FROM result where T_ID = $T_ID AND exam_ID = $exm_ID ;";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {

	echo"<tr>";
	?> <td> <?php echo $row["student_ID"]; ?> </td> 
   <td> <?php echo $row["Exam"]; ?> </td>
   <td> <?php echo $row["Result"]; ?> </td> 
   <td> <?php echo $row["Grade"]; ?> </td> 
   <?php
	 echo"</tr>";
}




?>
</table>


</body>
<footer>

<a align="center" href="AboutUs.htm">About Us |</a>
<a href="SupportUs.htm">Support |</a>
<a href="PrivacyPolicy.htm">Privacy Policy</a>

<p id="footer" align="center" style="font-size:15px">Mr.MCQ	|	All Rights Reserved</p>
</footer>
</html>
