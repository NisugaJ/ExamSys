<?php require 'config.php';
session_start();
if(isset($_SESSION["t_id"] ))
{
	header('location: UserAccount(Teacher).php');
}
if( isset($_SESSION["s_id"]) )
{
	header('location: UserAccount(Student).php');
}


//Admin Log In Check
/*if($_POST["User_Name"] === 'Admin' && $_POST["Password"] === 'admin123')
{
	$_SESSION["admin"] = 'Admin';
	header('location: AdminPage.php');
}*/
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel = "stylesheet" href="../CSS/Login.css" type="text/css">
<link rel = "stylesheet" href="../CSS/Home.css" type="text/css">

<title>
Login
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
<?php } ?>
</div>
</ul>
</header>
<body background="../images/light-color-background-images-for-websites-4.jpg" >
<br/>
<h2 align="center">Login</h2>

<form method="post" action="Login.php" >
User Name<br/><input type="text" name ="User_Name" required><br/>
Password<br/><input type="password" name="Password" required/><br/><br/>
<input type="submit" value="Login" name="Login"><br/>
<!-- <a href="www.google.lk" target="_blank"><button>Sign in with FaceBook</button></a> -->
</form>
<br/>
<p id="msg"></p>
<?php 


if( isset($_POST["Login"] ))
{	
	$user_name = $_POST["User_Name"];
	$password = $_POST["Password"];
	$pwd_hash = hash('sha512', $password);

	//Admin Log In Check
	if($user_name === 'Admin' && $password === 'admin123')
	{
		$_SESSION["admin"] =  'Admin';
		header('location: AdminPage.php');
	}

	//Teacher Log In Check
	$sql = "select * from teacher where username = '$user_name' AND password = '$pwd_hash' ";
	$result = mysqli_query($conn, $sql);
	if( $row = mysqli_fetch_assoc($result) )
	{
			echo '<h5 align="center">Valid User</h5>';
			//$_SESSION["loggedin"] = true;
			$_SESSION["firstname"] = $row["firstName"];
			$_SESSION["lastname"] = $row["lastName"];
			$_SESSION["email"] = $row["email"];
			$_SESSION["username"] = $row["username"];
			$_SESSION["t_id"] = $row["teacher_ID"];
			echo '<h5 align="center">Log In Successful</h5>';
			/*?>
			<h3 align="center"><?php echo $_SESSION["firstname"]."<br/>".$_SESSION["lastname"]."<br/>".$_SESSION["email"] ?> </h3>
			<?php	*/
			
			header('location: UserAccount(Teacher).php');	}
	
	//Student Log In Check
	$sql2 = "select * from student where username = '$user_name' AND password = '$pwd_hash' ";
	$result2 = mysqli_query($conn, $sql2);
	if( $row2 = mysqli_fetch_assoc($result2) )
	{
			echo '<h5 align="center">Valid User</h5>';
			//$_SESSION["loggedin"] = true;
			$_SESSION["firstname"] = $row2["firstName"];
			$_SESSION["lastname"] = $row2["lastName"];
			$_SESSION["email"] = $row2["email"];
			$_SESSION["username"] = $row2["username"];
			$_SESSION["s_id"] = $row2["student_ID"];
			
			header('location: UserAccount(Student).php');
	}
	
	//Invalid Log In
	else
	{
		//$_SESSION["loggedin"] = false;
		echo '<h4 align="center" >Invalid User</h4>';
		echo '<h4 align="center" >Click here to <a href="Login.php">Login</a> again</h4>';
		echo '<h4 align="center" >Not Registered yet ?</h4>';
		echo '<h4 align="center" >Click here to <a href="Register.htm">Register</a></h4>';
	}		
}



?>
</body>
<footer>


<a align="center" href="AboutUs.htm">About Us |</a>
<a href="SupportUs.htm">Support |</a>
<a href="PrivacyPolicy.htm">Privacy Policy</a>

<p id="footer" align="center" style="font-size:15px">Mr.MCQ	|	All Rights Reserved</p>
</footer>
</html>


