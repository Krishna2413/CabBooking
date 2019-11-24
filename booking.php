<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta name="description" content="Helps user to book a cab" />
  <meta name="keywords" content="HTML, Form, tags" />
  <meta name="author" content="Lakshmi Saketh"  />
  <title>Boooking</title>
</head>
<body>
<h1>Book a Cab</h1>
<p> Please fill the below to book a cab *Unit Number is not mandatory</p>
<form>
	
	
	<fieldset>
		<legend>Book a Cab</legend>
		<table>
		<tr><td><label for="pName">PassengerName</label> </td>
			<td><input type="text" name= "pName" id="pName" maxlength="20" size="10" required="required"/></td>
		</tr>
		<tr/>
		<tr><td><label for="phone">Contact Phone of Passenger</label> </td>
			<td><input type="text" name= "phone" id="phone" maxlength="20" size="10" required="required"/></td>
		</tr>
		<tr/>
		<tr><td>Pick Up Address: </td>
			<td>Unit Number: <input type="text" name= "unumber" id="unumber" maxlength="20" size="10"/></td></tr>
			
		<tr><td/><td>StreetNumber:<input type="text" name= "streetnum" id="streetnum" maxlength="20" size="10" required="required"/></td></tr>
		<tr><td/><td>Street Name:   <input type="text" name= "streetname" id="streetname" maxlength="20" size="10" required="required"/></td></tr>
		<tr><td/><td>Suburb Name:<input type="text" name= "suburb" id="suburb" maxlength="20" size="10" required="required"/></td></tr>
			
			
		</tr>
		<tr/>
		<tr>
		<td>
		<label for="dsuburb">Destination Suburb</label> </td>
			<td><input type="text" name= "dsuburb" id="dsuburb" maxlength="20" size="10" required="required"/></td>
		</tr>
		<tr/>
		<tr/>
		<tr><td><label for="ddate">Pickup Date</label> </td>
			<td><input type="date" name= "ddate" id="ddate" maxlength="20" size="10" required="required"/></td>
		</tr>
		<tr/>
		<tr><td><label for="pdate">Pikup Time</label> </td>
			<td><input type="time" name= "pdate" id="pdate" maxlength="20" size="10" required="required"/></td>
		</tr>
		</table>
	</fieldset>
	  
	<input type= "reset" value="Reset"/>   <input type= "submit" value="Book Cab"/>   
	
</form>
</body>
</html>
<?php
	session_start();//session variable
	if(isset($_GET['pName']) && isset($_GET['phone']) && isset($_GET['streetnum']) && isset($_GET['streetname']) && isset($_GET['suburb']) && isset($_GET['dsuburb']) && isset($_GET['pdate']) && isset($_GET['ddate']))
	{
	$pname = $_GET['pName'];
    	$streetnum= $_GET['streetnum'];
	$streetname= $_GET['streetname'];
	$suburb= $_GET['suburb'];
	$phone= $_GET['phone'];	
	$dsuburb= $_GET['dsuburb'];	
	$pdate= $_GET['pdate'];	
	$ddate= $_GET['ddate'];
	$status="unassigned";
	$email=$_SESSION["a"];
	
	$dt =  Date('H:i:s');
	//$result= $pdate->format('Y-m-d H:i:s');

	$start_time = strtotime($dt);
	$bookingID=uniqid();
	$end_time = strtotime($pdate);
	//echo $end_time;
	$diff = $end_time - $start_time;
	//echo 'Time diff in sec: '.abs($diff);
	//Echo "Email=".$email;
	if(isset($_GET['unumber']))
	{
		$unumber=$_GET['unumber'];
	}
	else
	{
		$unumber=Null;
	}
	require_once("settings.php");
	if($diff > 3600)//check the time difference is greater than one hour
	{
	//Using setting page for database credentials 
	
	 if(!$conn) 
	{
		echo"<p>Database connection failure</p>";
	} 
	else 
	{ 
		//echo"<p>Database connection Success</p>";
		
		$query="insert into Booking(BookingID,Email, Name, UnitNo, StreetNo, StreetName, suburb, dsuburb, Phone, Pdate, Ddate, Status) values('$bookingID','$email','$pname','$unumber','$streetnum','$streetname','$suburb','$dsuburb','$phone','$pdate','$ddate','$status')";
		//$query="insert into UserDetails(Email, Name, Password,Phone) values('$email','$username','$password',$phone)";
		$result = mysqli_query($conn,$query);
		if(!$result)
		{
			Echo" Inserting Data Failed Try Again";
			
		}
		else{
			//Echo"Data Inserted";
			$to=$email;
			$subject="Your booking request with CabsOnline!";
			
			$message="Dear ".$pname.", Thanks for booking with CabsOnline! Your booking reference number is ".$bookingID.". We will pick up the passengers in front of your provided address at ".$pdate.".";
			$headers="From booking@cabsonline.com.au";
			mail($to, $subject, $message, $headers, "-r 101734216@swin.edu.au");	
			Echo " Thanks for booking with CabsOnline! Your booking reference number is ".$bookingID.". We will pick up the ".$pname." in front of your provided address at ".$pdate.".";

			
		}
		}
	}
	else{
	Echo"Enter the Pickup time greater than one hour from now";
	}
		
	mysqli_close($conn);
	}
	
	
	
?>