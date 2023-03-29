<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
<link rel="stylesheet" type="text/css" href="login.css" />
</head>

<body>
<?php
//call file to connect to server
include ("header.php");?>

<?php
//This section processes submissions from the login form
//check if the form has been submitted
if($_SERVER['REQUEST_METHOD']== 'POST')
{
	
//validate the username
if(!empty($_POST['adminID']))
{
	$un= mysqli_real_escape_string($connect, $_POST['adminID']);
}

else
{
	$un = FALSE;
	echo '<p class = "error"> You forgot to enter your ID number.</p>';
}

//validate the password
if(!empty($_POST['password']))
{
	$p = mysqli_real_escape_string($connect, $_POST['password']);
}

else 
{
	$p = FALSE;
	echo '<p class = "error"> You forgot to enter your password.</p>';
}

//if no problems
if($un && $p)
{

//Retrieve data
	$q = "SELECT adminID, password FROM admin WHERE (adminID = '$un' AND password = '$p')";

//run the query and assign it to the variable $result
	$result = mysqli_query ($connect, $q);

	//count the number of rows that match the username/password combination
	//if one database row (record) matches the input:
	if(@mysqli_num_rows($result) == 1) 
	{
		//start the session, fetch the record and insert the
		session_start();
		$_SESSION = mysqli_fetch_array ($result, MYSQLI_ASSOC);

		echo '<script>window.location="homeadmin.html"</script>';

		//cancel the rest of the project
		exit();

		mysqli_free_result ($result);
		mysqli_close($connect);
		//no match was made 
	} 

	else 
	{
		echo '<p class = "error"> The id number and password entered do not match our records <br> Perhaps you need to register, just click the Register button</p>';
			}

	//If there was a problem
	}

	else
	{
		echo '<p class = "error"> Please try again. </p>';
	}
	mysqli_close ($connect);
}// end of submit conditional

?>

<div class="container" id="container">
            <div class="form-container log-in-container">
                <form action="loginadmin.php" method="post">
                    <h1>Login</h1><br>
                  <input type="text" placeholder="ID Number" name="adminID" value= "<?php if (isset($_POST['adminID'])) 
echo $_POST ['adminID'];?>" />
                    <input type="password" placeholder="Password" name="password" value= "<?php if (isset($_POST['password'])) 
echo $_POST ['password'];?>" />
                      <button>Log In</button>
                        <p>Login as student?<a href="login.php">&nbsp;Log In</a></p>
                </form>
            </div>
            <div class="overlay-container">
                <div class="overlay">
                  <div class="overlay-panel overlay-right">
                  <img src="https://www.kuptm.edu.my/images/2023/uptmLogo.png" style="width:85%"><br>
                        <h1> UPTM<br> Co-Curriculum<br> System</h1>
                  </div>
                </div>
            </div>
        </div>
    </body>
    </html>