<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Register</title>
<link rel="stylesheet" type="text/css" href="register.css" />
</head>

<body>
<?php
//call file to connect to server
include ("header.php");?>

<?php
//This query inserts a record 
//has form been submitted?
if ($_SERVER['REQUEST_METHOD']== 'POST')
{
	$error = array (); //initialize an error array

	//check for a id number
	if (empty($_POST['studentID']))
	{
		$error [] = 'You forgot to enter your id number.';
	}

	else
	{
		$i = mysqli_real_escape_string($connect, trim ($_POST ['studentID']));
	}

	//check for name
	if (empty($_POST['student_name']))
	{
		$error [] = 'You forgot to enter your name.';
	}

	else
	{
		$n = mysqli_real_escape_string($connect, trim ($_POST ['student_name']));
	}

	//check for email
	if (empty($_POST['email']))
	{
		$error [] = 'You forgot to enter your name.';
	}
	
	else
	{
		$e = mysqli_real_escape_string($connect, trim ($_POST ['email']));
	}

	//check for programme
	if (empty($_POST['programme']))
	{
		$error [] = 'You forgot to enter your programme.';
	}

	else
	{
		$d = mysqli_real_escape_string($connect, trim ($_POST ['programme']));
	}

	//check for telephone number
	if (empty($_POST['phone']))
	{
		$error [] = 'You forgot to enter your phone.';
	}

	else
	{
		$t = mysqli_real_escape_string($connect, trim ($_POST ['phone']));
	}

	//check for password
	if (empty($_POST['password']))
	{
		$error [] = 'You forgot to enter your password.';
	}

	else
	{
		$p = mysqli_real_escape_string($connect, trim ($_POST ['password']));
	}

	//register the user in the database
	//make the query
	$q = "Insert INTO student (studentID, student_name, email, programme, phone, password) 
	VALUES ('$i', '$n', '$e', '$d', '$t', '$p')";
	$result = @mysqli_query ($connect, $q);  //run the query

	if ($result)
	{  
		//if it run
		echo '<script>window.location="login.php"</script>';
		exit();
	}

	else
	{  
		//if it did run
		//message
		echo '<h1>System error</h1>';

		//debugging message
		echo '<p>' .mysqli_error($connect). '<br><br>Query: '.$q. '</p>';
	} //end of if (result)

	mysqli_close($connect); //close the databse connection
	exit();

}//end of the main submit conditional
?>

<div class="container">
        <div class="title">Register Now!</div><br>
        <form action="register.php" method="post">
            <div class="user-details">
			<div class="input-box">
                    <span class="details">ID Number</span>
                    <input type="text" name="studentID" value="<?php if (isset($_POST['studentID'])) echo $_POST['studentID']; ?>" required/>
                </div>
                <div class="input-box">
                    <span class="details">Name</span>
                    <input type="text" name="student_name" value="<?php if (isset($_POST['student_name'])) echo $_POST['student_name']; ?>" required />
                </div>
				<div class="input-box">
                    <span class="details">Email</span>
                    <input type="text" name="email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" required/>
                </div>
                <div class="input-box">
                    <span class="details">Programme</span>
                    <input type="text" name="programme" value="<?php if (isset($_POST['programme'])) echo $_POST['programme']; ?>" required/>
                </div>
                <div class="input-box">
                    <span class="details">Telephone Number</span>
                    <input type="text" name="phone" value="<?php if (isset($_POST['phone'])) echo $_POST['phone']; ?>" required />
                </div>
                <div class="input-box">
                    <span class="details">Password</span>
                    <input type="password" name="password" value="<?php if (isset($_POST['password'])) echo $_POST['password']; ?>" required/>
                </div>
            </div>
            <div class="button">
                <input type="submit" value="Register">
            </div>
        </form>
    </div>
</body>
</html>