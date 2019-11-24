<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta name="description" content="Helps user to login into page" />
  <meta name="keywords" content="HTML, Form, tags" />
  <meta name="author" content="Lakshmi Saketh"  />
  <title>Cabs online</title>
</head>
<body>
<h1>Login to Cabs Online</h1>

<form>
	
	
	<fieldset>
		<legend>Login</legend>
		<table>
		<tr>
		<td>
		<label for="email">Email</label> </td>
			<td><input type="text" name= "email" id="email" maxlength="50" size="25" required="required"/></td>
		</tr>
		<tr/>
		<tr><td><label for="password">Password</label> </td>
			<td><input type="password" name= "password" id="password" maxlength="50" size="25" required="required"/></td>
		</tr>
		</table>
	</fieldset>
	  
	<input type= "submit" value="Login"/>
	<h2> New Member ? <a href=register.php>Register</a></h2>
</form>
</body>
</html>

<?php
	session_start();
	if(isset($_GET['email']) && isset($_GET['password']) )
	{
	$email = $_GET['email'];
       $password = $_GET['password'];
	//echo $email;
	//echo $password;
	//Using setting page for database credentials 
	require_once("settings.php");
		 if(!$conn) {
		echo"<p>Database connection failure</p>";
	} 
	else 
	{ 
		//echo"<p>Database connection Success</p>";
		$query="SELECT * FROM UserDetails WHERE Email = '$email' and Password = '$password'";
		$result = mysqli_query($conn,$query);
      		//$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
     	        //$active = $row['password'];
      
      		$count = mysqli_num_rows($result);	
		if($count > 0)
 		 {
 			  //session_register("myusername");
        		 //$_SESSION['login_user'] = $myusername;
         		$_SESSION["a"]=$email;
        		header("location: booking.php");
			Echo " Login Success";
 		 }
		else{
			Echo " Login Failed Check Email or Password";
			}
		//if(mysqli_num_rows($result)  > 0)
		//{
			
		//}
mysqli_close($conn);
	}
	}
	
	
	
?>