<?php   session_start();
		require'config.php';
	if( !isset($_SESSION["admin"] ) )
    { header('location: Login.php');}

 ?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel = "stylesheet" href="../CSS/Home.css" type="text/css">
<link rel = "stylesheet" href="../CSS/Taccount.css" type="text/css">
<style>
footer {
	background-color:#e6e6e6;
    padding:10px;
    text-align:center;
	bottom:0;
	left:0;
	right:0;
	position:unset;
	margin-top:500px;

}
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
	Administration
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
<li class="button" id="account_button"><a href="AdminPage.php" >Account <img src="../images/profile_icon.jpg" height="15px" width="15px"></a></li>
<li class="button"><a href="Logout.php" >Logout</a></li>
</div>
</ul>
</header>

<body background="../images/light-color-background-images-for-websites-4.jpg">
<br/>
<div align="center">
<br/><br/>
<label><b> Adminstration</b></label><br/><br/>
<br/><br/>
<br/>
<table id="table_type">
<form method="post">
<th><button name="Students">Students</button></th>
<th><button name="Teachers">Teachers</button></th>


</form>

</table>
<br/>
<table>
<?php 
	//$Tid = $_SESSION["t_id"];
	if ( isset($_POST["Students"] )   )
	{
		$sql = "select * from student ";
		$result = mysqli_query($conn, $sql);
		if( mysqli_num_rows($result) > 0 )
		{
			?>
			<th>Student ID</th>
			<th>First Name</th>
            <th>Last Name</th>
            <th>username</th>
            <th>email</th>
      
           
        	
			<?php
			while( $row = mysqli_fetch_array($result) )
			{
				?>
                <tr>
				<td><?php echo $row["student_ID"]; ?></td>
				<td><?php echo $row["firstName"]; ?></td>
                <td><?php echo $row["lastName"]; ?></td>
                <td><?php echo $row["username"]; ?></td>
                <td><?php echo $row["email"]; ?></td>
                <?php echo '<td><a name="del_'.$row['student_ID'].'" href="AdminPage.php?id='.$row['student_ID'].'">Delete</a> </td>' ?>
                </tr>
				<?php
			}
		}
		if( isset($_GET["id"] ))
		{
			$del_std_id = $_GET["id"] ;
			$sql ="delete from student where student_ID = '$del_std_id' ";			
			$result = mysqli_query($conn, $sql);
			if($result)
			{
				echo'<h3 style="color:red"> Successfully Deleted</h3>';	
				?>
                <script>    
				if(typeof window.history.pushState == 'function') 
				{
					window.history.pushState({}, "Hide", "http://localhost:81/Mr.MCQ/pages/AdminPage.php");
				}
				</script>
                <?php
			}
		}
		
		
	}
?>
<?php 
	//$Tid = $_SESSION["t_id"];
	if ( isset($_POST["Teachers"] )   )
	{
		$sql = "select * from teacher ";
		$result = mysqli_query($conn, $sql);
		if( mysqli_num_rows($result) > 0 )
		{
			?>
			<th>Teacher ID</th>
			<th>First Name</th>
            <th>Last Name</th>
            <th>username</th>
            <th>email</th>
          
			<?php
			while( $row = mysqli_fetch_array($result) )
			{
				?>
                <tr>
				<td><?php echo $row["teacher_ID"]; ?></td>
				<td><?php echo $row["firstName"]; ?></td>
                <td><?php echo $row["lastName"]; ?></td>
                <td><?php echo $row["username"]; ?></td>
                <td><?php echo $row["email"]; ?></td>
                <?php echo '<td><a name="del_'.$row['teacher_ID'].'" href="AdminPage.php?id='.$row['teacher_ID'].'">Delete</a> </td>' ?>
                </tr>
				<?php
			}
		}
		if( isset($_GET["id"] ))
		{
			$del_tch_id = $_GET["id"] ;
			$sql ="delete from teacher where teacher_ID = '$del_tch_id' ";			
			$result = mysqli_query($conn, $sql);
			if($result)
			{
				echo'<h3 style="color:red"> Successfully Deleted</h3>';	
				?>
                <script>    
				if(typeof window.history.pushState == 'function') 
				{
					window.history.pushState({}, "Hide", "http://localhost:81/Mr.MCQ/pages/AdminPage.php");
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