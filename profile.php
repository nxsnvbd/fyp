<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Profile</title>
<link rel="stylesheet" type="text/css" href="profile.css" />
</head>

<body>
    <div class="navbar">
  <a href="login.html">Log Out</a>
  <a href="profile.html">Profile</a>
  <a href="registration.html">Registration Form</a>
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

//look for a valid user id, either through GET or POST
if ((isset ($_GET['id'])) && (is_numeric($_GET['id']))) {
	$id = $_GET['id'];
}elseif ((isset($_POST['id'])) && (is_numeric($_POST['id']))){
	$id = $_POST['id'];
}else{
	echo '<p class ="error">This page has been accesed in error.</p>';
	exit();
}

//make the query
$q= "SELECT studentID, student_name, programme, phone, password FROM student WHERE studentID='$id' ";

//run the query
$result= @mysqli_query ($connect, $q);

//if it ran withut a problem, display the records
if($result)
{
	//fetch and print all the records
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
	{
		echo '<div class="main-body">
        <div class="row-gutters-sm">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <h1 align="center"><strong>My Profile</strong></h1>
                            <img src="https://cdn-icons-png.flaticon.com/512/1077/1077114.png" class="center" width="30%">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Full Name</h6>
                            </div>
                            <div class="col-sm-9 text secondary">
                            ' .$row ['student_name']. '
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">ID Number</h6>
                            </div>
                            <div class="col-sm-9 text secondary">
                            ' .$row ['studentID']. '
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Telephone Number</h6>
                            </div>
                            <div class="col-sm-9 text secondary">
                            ' .$row ['phone']. '
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Programme</h6>
                            </div>
                            <div class="col-sm-9 text secondary">
                            ' .$row ['programme']. '
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Password</h6>
                            </div>
                            <div class="col-sm-9 text secondary">
                            ' .$row ['password']. '
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>';
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
