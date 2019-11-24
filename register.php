<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta name="description" content="Helps user to register" />
  <meta name="keywords" content="HTML, Form, tags" />
  <meta name="author" content="Lakshmi Saketh"  />
  <title>User Registraton</title>
</head>
<body>
<h1>Register in Cabs Online</h1>
<p> Please fill the below form to complete your registration</p>
<form>
	
	
	<fieldset>
		<legend>User Registration</legend>
		<table>
		<tr><td><label for="username">UserName</label> </td>
			<td><input type="text" name= "username" id="username" maxlength="20" size="10" required="required"/></td>
		</tr>
		<tr/>
		<tr><td><label for="password">Password</label> </td>
			<td><input type="password" name= "password" id="password" maxlength="20" size="10" required="required"/></td>
		</tr>
		<tr/>
		<tr><td><label for="cpassword">ConfirmPassword</label> </td>
			<td><input type="password" name= "cpassword" id="cpassword" maxlength="20" size="10" required="required"/></td>
		</tr>
		<tr/>
		<tr>
		<td>
		<label for="email">Email</label> </td>
			<td><input type="text" name= "email" id="email" maxlength="50" size="10" required="required"/></td>
		</tr>
		<tr/>
		<tr/>
		<tr><td><label for="phone">Phone</label> </td>
			<td><input type="text" name= "phone" id="phone" maxlength="20" size="10" required="required"/></td>
		</tr>
		<tr/>
		</table>
	</fieldset>
	  
	<input type= "submit" value="Register"/>
	<h2> Already Registered ? <a href=login.php>Login Here</a></h2>
</form>
</body>
</html>
<?php
	session_start();
	if(isset($_GET['username']) && isset($_GET['password']) && isset($_GET['cpassword']) && isset($_GET['email']) && isset($_GET['phone']))
	{
	$email = $_GET['email'];
        $password = $_GET['password'];
	$cpassword= $_GET['cpassword'];
	$username= $_GET['username'];
	$phone= $_GET['phone'];	//Using setting page for database credentials 
	require_once("settings.php");
	 if(!$conn || !($password==$cpassword)) 
	{
		echo"<p>Database connection failure or password mismatch</p>";
	} 
	else 
	{ 
		echo"<p>Database connection Success</p>";
		$query1="SELECT * FROM UserDetails WHERE Email = '$email'";
		$result1 = mysqli_query($conn,$query1);
      		$count = mysqli_num_rows($result1);	
		if($count > 0){
			Echo" Email Already Exist";
		}
		else
		{

		$query="insert into UserDetails(Email, Name, Password,Phone) values('$email','$username','$password',$phone)";
		$result = mysqli_query($conn,$query);
		if(!$result)
		{
			Echo" Inserting Data Failed Try Again";
			
		}
		else{
			$_SESSION["a"]=$email;
        		header("location: booking.php");
			Echo " Registration Success";

			Echo"Data Inserted";
		}
		}
		
	mysqli_close($conn);
	}
	}
	
?>