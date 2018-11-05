
<?php
    require'config.php';
    session_start();
  	if(!isset($_SESSION["t_id"]) ) 
    { header('location: Login.php');}

   
   if(isset($_GET["dur"])){ $duration = $_GET["dur"];}
    $t_ID = $_SESSION["t_id"];
?><!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Exam Paper</title>
<link rel="stylesheet" type="text/css" href="./clockpicker-gh-pages/assets/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="./clockpicker-gh-pages/dist/bootstrap-clockpicker.min.css">
<link rel="stylesheet" type="text/css" href="../clockpicker-gh-pages/assets/css/github.min.css">

<script type="text/javascript" src="./clockpicker-gh-pages/assets/js/jquery.min.js"></script>
<script type="text/javascript" src="./clockpicker-gh-pages/assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="./clockpicker-gh-pages/dist/bootstrap-clockpicker.min.js"></script>


<link rel = "stylesheet" href="../CSS/Home.css" type="text/css">

<link rel = "stylesheet" href="../CSS/ConductExam.css" type="text/css">
 <style> 
   .container {
    padding: 20px;
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
<br/><br/><br/><br/><br/>
<body background="../images/light-color-background-images-for-websites-4.jpg" >
<br/><br/>
<h2 name="papername" align="center">Paper : <?php if(isset($_GET["dur"])){ echo $_GET["name"]; }?></h2>

<form name="conductexam" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
    <input name="paperID" hidden value=" <?php if(isset($_GET["id"])) {echo $_GET["id"];}?>"/>
	Exam Name:<br/>
	<input type="text" name="Examname" value="<?php if(isset($_GET["name"])){echo $_GET["name"];}?>" required><br/><br/>
	Exam Quiz Password:<br/>
	<input type="text" name="Quizpwd" pattern="^(?=.*\d)(?=.*[a-z])(?!.*\s).*$" title="Please include at least 1 lowercase character, and 1 number." required><br/><br/>
	
    Duration(in Min )<br>
	<input type="number" name="duration" min="5" max="180" title="Between 5 - 180" value="<?php echo $duration ?>" required><br>
    Exam Expiration Date:<br/>
	<input type="date" name="expDate"  title="Enter Expiry Date" required><br/><br/>
     Exam Expiration Time:<br/>
    <!-- <input type="time" name="expTime"  title="Enter Expiry Time" required><br/><br/> -->
    <div class="container">
    <input id="input-a" value="" data-default="20:48" name="expTime" required> <br/><br/>
</div>
<script type="text/javascript">
var input = $('#input-a');
input.clockpicker({
    autoclose: true
});

// Manual operations
$('#button-a').click(function(e){
    // Have to stop propagation here
    e.stopPropagation();
    input.clockpicker('show')
            .clockpicker('toggleView', 'minutes');
});
$('#button-b').click(function(e){
    // Have to stop propagation here
    e.stopPropagation();
    input.clockpicker('show')
            .clockpicker('toggleView', 'hours');
});
</script>
    <br/>
    <input type="submit" name="conduct" value="Conduct" id="submit" />
</form>

</body>

<footer>

<a align="center"  href="AboutUs.htm">About Us |</a>
<a href="SupportUs.htm">Support |</a>
<a href="PrivacyPolicy.htm">Privacy Policy</a>

<p id="footer" align="center" style="font-size:15px">Mr.MCQ	|	All Rights Reserved</p>
</footer>
</html>


<?php 
if(isset($_POST["conduct"]))
{
        echo $_POST["expDate"];
        echo $_POST["expTime"];
        $exam_name = $_POST["Examname"];
        $Quizpwd = $_POST["Quizpwd"]; 
        $duration_new = $_POST["duration"];
        $exampaper_ID = $_POST["paperID"];
        $exp_date = $_POST["expDate"];
    
        $exp_time = $_POST["expTime"] ;

        $sql = "insert into `examination` values( NULL, '$exam_name', '$Quizpwd', '$exp_date', '$exp_time', $t_ID, $exampaper_ID, $duration_new)";

        $result = mysqli_query($conn, $sql);

        if($result)
        {
            header('location: http://localhost:81/Mr.MCQ/pages/UserAccount(Teacher).php'); 
        }
        else{
            $conn->error;
    }

}

?>
