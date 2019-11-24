<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<meta name="description" content="SQL Connection details"/>
<meta name="keywords" content="PHP, MySql"/>
<title> MYSql Connectivity</title>
</head>

<body>

	<?php


	$host= "";
	$user="";
	$pwd="";
	$sql_db="";

	$conn = @mysqli_connect($host,
			$user,
			$pwd,
			$sql_db
		);

	
	?>