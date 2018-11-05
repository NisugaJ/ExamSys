<?php 
    require'config.php';
session_start(); ?>

<!DOCTYPE html>
<html><head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">



<link rel = "stylesheet" href="../CSS/ContactUs.css" type="text/css">
<link rel = "stylesheet" href="../CSS/Home.css" type="text/css">
<title>
	Contact us
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
<br/>	<h2 align="center"><b>Contact Us</b></h2>
    
<form name="contactus" action="" method="post" >

	First Name:<br/>
	<input type="text" name="First_Name" pattern="[a-zA-Z]{2,30}" title="Use Only Alphabets" required><br/><br/>
	Last Name:<br/>
	<input type="text" name="Last_Name" pattern="[a-zA-Z]{2,30}" title="Use Only Alphabets" required><br/><br/>
	E-mail:<br/>
	<input type="email" name="E-Mail" required title="Enter a Valid Email Address"><br/><br/>
	<input type="text" name="Comments" placeholder="Comments/Questions" title="Enter Your Comment/Question" required><br/><br/>
    
    <br/>
    <input type="submit" value="Submit" id="submit" name="submit"  />
</form>

</body>
<footer>

<a align="center" href="AboutUs.htm">About Us |</a>
<a href="SupportUs.htm">Support |</a>
<a href="PrivacyPolicy.htm">Privacy Policy</a>

<p id="footer" align="center" style="font-size:15px">Mr.MCQ	|	All Rights Reserved</p>
</footer>
</html>


<?php
if(isset($_POST["submit"]))
{
	$fname = $_POST["First_Name"];
	$lname = $_POST["Last_Name"];
	$email = $_POST["E-Mail"];
    $que = $_POST["Comments"];
    
    $sql="insert into contact_us(fname,lanme,email,que) values('$fname','$lname','$email','$que')";
    
    $result = mysqli_query($conn,$sql);
    
    if($result){
		echo"succeedd";
		header('location: http://localhost:8080/Mr.MCQ/pages/help.php');
    }
    else{
        echo "Error -> ",$conn->error;
    }
}
mysqli_close($conn);
?>

