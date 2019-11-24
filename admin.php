<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta name="description" content="Display the admin page and content handling" />
  <meta name="keywords" content="HTML, Form, tags" />
  <meta name="author" content="Lakshmi Saketh"  />
  <title>Cabs online Admin</title>
</head>
<body>

<h1>Admin page of cabs online </h1>
<form>
	<!--Note we have to use a special escape character to print an apostrophe on the Web page -->
	<h2>1. Enter reference number and click submit to assign the cab for the request </h2>
	Reference Number: <input type="text" name= "refnumber" id="refnumber"  />  <br/><input type= "submit" value="Update" name="update"/>
	
	


<br/>
<br/>


	<!--Note we have to use a special escape character to print an apostrophe on the Web page -->
	
	<h2>2. click below button to search all unassigned booking request with the pickup time less than 2 hours </h2>
	<input type= "submit" value="List all" name="refnum"/>
	
</form>
<br/>
<br/>
</body>
</html>

<?php 

if (isset($_GET['refnum'])) 
{
   //do something here;
require_once("settings.php");
 if(!$conn) 
	{
		echo"<p>Database connection failure</p>";
	} 
	else 
	{ 

   //do something here;DATE_ADD(NOW(), INTERVAL 2 HOUR);
$result = mysqli_query($conn,"SELECT a.NAME as pName, b.BookingID, b.Name,b.Phone,b.StreetNo,b.StreetName,b.suburb,b.dsuburb,TIME_FORMAT(b.pdate, '%H:%i') as pdate,DATE_FORMAT(b.ddate, '%d %M ') as ddate FROM Booking b, UserDetails a WHERE a.Email = b.Email and (CAST(b.ddate AS DATETIME) + CAST(b.pdate AS DATETIME) >= (NOW() - INTERVAL 2 HOUR) )and status='unassigned' ");

echo "<table border='1'>
<tr>
<th>reference number#</th>
<th>customer name</th>
<th>passenger name</th>
<th>Passenger contact no</th>
<th>Pickup Address</th>
<th>destination suburb</th>
<th>Pick Time</th>
</tr>";

while($row = mysqli_fetch_assoc($result))
{
//$result=date('F j',strtotime($row['ddate']));
echo "<tr>";
echo "<td>" . $row['BookingID'] . "</td>";
echo "<td>" . $row['pName'] . "</td>";
echo "<td>" . $row['Name'] . "</td>";
echo "<td>" . $row['Phone'] . "</td>";
echo "<td>" . $row['StreetNo'].",".$row['StreetName'].",".$row['suburb']. "</td>";
echo "<td>" . $row['dsuburb'] . "</td>";

echo "<td>" .$row['ddate'].",". $row['pdate'] . "</td>";

echo "</tr>";
}
echo "</table>";

mysqli_close($conn);
}

}

else if(isset($_GET['update']))
{
require_once("settings.php");
 if(!$conn) 
	{
		echo"<p>Database connection failure</p>";
	} 
	else 
	{ 
	if(isset($_GET['refnumber']))
	{
	$refnumvar=$_GET['refnumber'];
	$status="assigned";
	Echo $refnumvar;
	$query="UPDATE Booking SET status='$status' WHERE BookingID='$refnumvar'";
	$result = mysqli_query($conn,$query);
		if($result)
		{
			Echo" Taxi Assigned ";
			
		}
		else{
			Echo"Wrong Reference Number";
			}

	}
	else
	{
		Echo " Please type reference number";
	}
		
	}
}


?>