<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Notification</title>
<link rel="stylesheet" type="text/css" href="home.css" />
</head>

<body>


<div class="navbar">
  <a href="login.php">Log Out</a>
  <a href="notification.php">Notification</a>
  <a href="registration.php">Registration</a>
  <div class="dropdown">
    <button class="dropbtn">Category 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="academic.html">Academic</a>
      <a href="arts.html">Humanities/Arts</a>
      <a href="sports.html">Sports</a>
    </div>
  </div> 
    <a href="home.html">Home</a>

</div>

<?php include ("header.php");?>

<?php
// Start a session
session_start();

// Check if the user is logged in
if(isset($_SESSION['email'])) {

  // Retrieve the user's data from the session variables
  $email = $_SESSION['email'];
}
?>


<?php
//make the query
$q= "SELECT name, email, clubs, status FROM registration";

//run the query
$result= @mysqli_query ($connect, $q);

//if it ran withut a problem, display the records
if($result)
{
	//table heading
	echo '<h2 align="center">Notification</h2><br><table align="center" border="1">
	<td><b>&nbsp;Name&nbsp;</b></td>
	<td><b>&nbsp;Email&nbsp;</b></td>
	<td><b>&nbsp;Club&nbsp;</b></td>
	<td><b>&nbsp;Status&nbsp;</b></td></tr>';

	//fetch and print all the records
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
	{
		echo '<tr>
		<td>&nbsp;' .$row ['name']. '&nbsp;</td>
		<td>&nbsp;' .$row ['email']. '&nbsp;</td>
		<td>&nbsp;' .$row ['clubs']. '&nbsp;</td>
		<td>&nbsp;' .$row ['status']. '&nbsp;</td>
		</tr>';
	}
	//close the table
	echo '</table>';

	//free up the resources
	mysqli_free_result ($result);
}

//if failed to run
else 
{
	//error message
	echo '<p class ="error">The current user could not be retrieved. We apologized for any inconvenience.</p>';

	//debugging message
	echo '<p>' .mysqli_error($connect). '<br><br>Query: '.$q. '</p>';
}//end of it ($result)

//close the database connection
mysqli_close($connect);

?>

</body>
</html>
