<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>The Argenti Club</title>
<link rel="stylesheet" type="text/css" href="h9.css"/>
</head>
</head>

<body>
<div class="navbar">
  <a href="loginadmin.php">Log Out</a>
  <div class="dropdown">
    <button class="dropbtn">Category 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="academicadmin.html">Academic</a>
      <a href="artsadmin.html">Humanities/Arts<as/a>
      <a href="sportsadmin.html">Sports</a>
    </div>
  </div> 
    <a href="homeadmin.html">Home</a>
</div>

&nbsp;
<h1 align="center"><strong>The Argenti Club</strong></h1>

<p align="center"><img src="argenti.png" width="20%" ></p>

<?php include ("header.php");?>

<div>
	<h2 align="center">Requests</h2>

	<table border="1" align="center">
		<tr>
			<td>Name</td>
			<td>Email</td>
			<td>Action</td>
		</tr>

		<?php
		$query= "SELECT * FROM registration WHERE status='pending' and clubs='The Argenti Club' ";
		$result= @mysqli_query ($connect, $query);
		while ($row = mysqli_fetch_array($result)){
			?>

		<tr>
			<td><?php echo $row ['name'];?></td>
			<td><?php echo $row ['email'];?></td>

		<td>
		<form action="a3admin.php" method="POST">
			<input type="hidden" name ="email" value="<?php echo $row ['email'];?>"/>
			<input type="submit" name ="approve" value="Approve"/>
			<input type="submit" name ="deny" value="Deny"/>
		</form>
		</td>
		</tr>
	</table>

		<?php
		}
		?>
</div>
<?php

if (isset($_POST['approve'])){
	$email = $_POST['email'];

	$select = "UPDATE registration SET status='approved' WHERE email='$email'";
	$result= @mysqli_query ($connect, $select);

	echo '<script type = text/javascript">';
	echo 'alert ("Registration Approved!");';
	echo 'window.location.href = "a3admin.php"';
	echo '</script>';
}

if (isset($_POST['deny'])){
	$email = $_POST['email'];

	$select = "DELETE FROM registration WHERE email='$email'";
	$result= @mysqli_query ($connect, $select);

	echo '<script type = text/javascript">';
	echo 'alert ("Registration Denied!");';
	echo 'window.location.href = "a3admin.php"';
	echo '</script>';
}
?>

</body>