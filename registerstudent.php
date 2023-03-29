<html>
<head>
	<title>Register Student</title>
</head>
<body>

<?php
//call file to connect to server
include ("header.php");?>

<?php
//This query inserts a record in the clinic table
//has form been submitted?
if ($_SERVER['REQUEST_METHOD']== 'POST')
{
	$error = array (); //initialize an error array

	//check id number
	if (empty($_POST['id']))
	{
		$error [] = 'You forgot to enter your ID number.';
	}

	else
	{
		$i = mysqli_real_escape_string($connect, trim ($_POST ['id']));
	}

	//check for a name
	if (empty($_POST['name']))
	{
		$error [] = 'You forgot to enter your name.';
	}

	else
	{
		$n = mysqli_real_escape_string($connect, trim ($_POST ['name']));
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

	//check for programme
	if (empty($_POST['programme']))
	{
		$error [] = 'You forgot to enter your programme.';
	}

	else
	{
		$r = mysqli_real_escape_string($connect, trim ($_POST ['programme']));
	}

	//register the user in the database
	//make the query
	$q = "Insert INTO student (id, name, password, programme) VALUES ('$i', '$n', '$p', '$r')";
	$result = @mysqli_query ($connect, $q);  //run the query

	if ($result)
	{  
		//if it run
		echo '<h1>Thank you</h1>';
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

<h2> Register Student </h2>
<h4> * required field </h4>
<form action = "registerstudent.php" method="post">

<p><label class = "label" for="name">Name:</label>
<input id="name" type="text" name="name" size="30" maxlength="150"
value="<?php if (isset($_POST['name'])) echo $_POST['name']; ?>" /></p>

<p><label class ="label" for ="id"> ID Number :</label>
<input id = "ic" name="ic" type="text" name="ic" size="20" maxlength="15"
value="<?php if (isset($_POST['id'])) echo $_POST ['id']; ?> "/></p>

<p><label class = "label" for="password">Password:</label>
<input id="text" type="password" name="password" size="25" maxlength="20"
value="<?php if (isset($_POST['password'])) echo $_POST['password']; ?>" /></p>

<p><label class = "label" for="programme">Programme:</label>
	<select name="programme" id="programme" value="<?php if (isset($_POST['programme'])) echo $_POST['programme']; ?>">
	<option></option>
    <option>AA103</option>
    <option>BE101</option>
    <option>BK101</option>
    <option>CC101</option>
    <option>CT206</option>
    <option>CT203</option>
</select>
</p>

<p><input id="submit" type="submit" name="submit" value="Register" /> &nbsp;&nbsp;
<input id="reset" type="reset" name="reset" value="Clear All" /></p>

</form>
</body>
</html>