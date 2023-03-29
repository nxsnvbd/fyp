<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Registration Form</title>
<link rel="stylesheet" type="text/css" href="registration.css" />
</head>

<body>
<?php
//call file to connect to server
include ("header.php");?>

<?php
  session_start();
//This query inserts a record 
//has form been submitted?
if ($_SERVER['REQUEST_METHOD']== 'POST')
{
	$error = array (); //initialize an error array

	//check for a email
	if (empty($_POST['email']))
	{
		$error [] = 'You forgot to enter your email.';
	}

	else
	{
		$e = mysqli_real_escape_string($connect, trim ($_POST ['email']));
	}

  	//check for a name
	if (empty($_POST['name']))
	{
		$error [] = 'You forgot to enter your name.';
	}

	else
	{
		$a = mysqli_real_escape_string($connect, trim ($_POST ['name']));
	}


	//check for clubs
	if (empty($_POST['clubs']))
	{
		$error [] = 'You forgot to enter your clubs.';
	}

	else
	{
		$n = mysqli_real_escape_string($connect, trim ($_POST ['clubs']));
	}

	//register the user in the database
	//make the query
	$q = "Insert INTO registration (email, name, clubs, status) 
	VALUES ('$e', '$a', '$n', 'pending')";
	$result = @mysqli_query ($connect, $q);  //run the query

	if ($result)
	{  
		//if it run
		echo '<script>window.location="home.html"</script>';
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

<br><br>

<form action="registration.php" method="post">
<div class="form-container">
<ul class="list">
<li><h2>Do you want to register to any clubs?</h2><br /></li>

<li><label>Name</label></li>
<li><input type="text" name="name" value="<?php if (isset($_POST['name'])) echo $_POST['name']; ?>" required/></li>

<li><label>Email</label></li>
<li><input type="text" name="email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" required/></li>

<br><label for="clubs">Clubs:&nbsp;</label>
  <select name="clubs" id="clubs">
    <option value="null">---select list---</option>
    <option selected disabled>Academic:</option>
    <option value="Youth Orator Club">Youth Orator Club</option>
    <option value="The Magister Club">The Magister Club</option>
    <option value="The Argenti Club">The Argenti Club</option>
    <option value="English Society Club">English Society Club</option>
    <option value="Accounting Club">Accounting Club</option>
    <option value="Society of Corporate Administration">Society of Corporate Administration</option><br>
    <option select disabled>Humanities/Arts:</option>
    <option value="Smart Caliph Society Club">Smart Caliph Society Club</option>
    <option value="Usahawan">Usahawan</option>
    <option value="The Vocalism">The Vocalism</option>
    <option value="Akasia">Akasia</option>
    <option value="Anak Teater">Anak Teater</option>
    <option value="Angakatan Mahasiswa Anti Rasuah">Angkatan Mahasiswa Anti Rasuah</option>
    <option value="Fasilitator">Fasilitator</option>
    <option value="Creative Media Club">Creative Media Club</option>
    <option value="Sekretriat Rakan Muda">Sekretriat Rakan Muda</option><br>
    <option select disabled>Sports:</option>
    <option value="Panthera Netball Club">Panthera Netball Club</option>
    <option value="Club Chess Kasparov">Club Chess Kasparov</option>
    <option value="Table Tennis Club">Table Tennis Club</option>
    <option value="Kelab Silat Seni Gayong">Kelab Silat Seni Gayong UPTM</option>
    <option value="Taekwando">Club Taekwando</option>
    <option value="White Eagles Volleyball Club">White Eagles Volleyball Club</option>
    <option value="Panthers Rugby Club">Panthers Rugby Club</option>
    <option value="Scorpio Lethic(Track and Field)">Scorpio Lethic (Track and Field)</option>
    <option value="UPTM Eagles FC">UPTM Eagles FC</option>
    <option value="Extreme Youth Club">Extreme Youth Club</option>
    <option value="UPTM Futsal Club">UPTM Futsal Club</option>
    <option value="Pregerine Archers">Pregerine Archers</option>
    <option value="Eagles Paintball Club">Eagles Paintball Club</option>
    <option value="Eagles Basketball Club">Eagles Basketball Club</option>
    <option value="Eagles Hockey Club">Eagles Hockey Club</option>
  </select>
  <br><br>

<li><input type="submit" value="Register"></li>
</ul>
</div>

</form>
</body>
</html>