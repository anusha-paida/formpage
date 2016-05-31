<html>
<head>
<title>Register page</title>
<style>

#Header {
	background-color:#A7C942;
	color:white;
	text-align:center;
	padding:6px;
}
b4 {
	color: green;
	font-family: arial;
	font-size: 16px;
}

b5 {
	color: red;
	font-family: arial;
	font-size: 10px;
}

b6 {
	color: black;
	font-family: arial;
	font-size: 14px;
}

}
</style>
<h1 id = "Header">New User Registration</h1>
</head>
<body>
	<form method="post" enctype="multipart/form-data">
		<b5> 
		(* required)
		<br>
		<br>
		</b5>
		<hr size="2"></hr>
		<b4>Name</b4>
		

		<table border="0">
			<tr>
				<td>First Name*</td>
				<td>Last Name*</td>
			</tr>
			<tr>
				<td><input type="text" name="firstname" required></td>
				<td><input type="text" name="lastname" required></td>
			</tr>
		</table>
		<br>
		<hr size="2"></hr>
		</b6>

		<b4> Profile Picture </b4>
		<br> <br>
		<table border="0">
			<tr>
				<td>
				<input name="profilepic" accept = "image/jpeg" type="file"><br><br>
			</tr>
		</table>
		
		<b4> Description </b4>
	
		<table border="0">
			<tr>
				<td>
				<input type="text" name="Description"style="width:500px;height:100px; border:1px solid black"/><br></td>
			</tr>		
		</table>
		<br>
		<b4> Notes </b4>
		
		<table border="0">
			<tr>
				<td>
				<input type="text" name="Notes"style="width:500px;height:100px; border:1px solid black"/><br></td>
			</tr>		
		</table>

		<hr size="1"></hr>
		<p>
			<input type="submit" value="submit" name="submit">
		</p>
<?php
	if(isset($_POST['submit'])){

	//$con = mysql_connect('98.130.0.108','sarcoix_demouser','1UserLogin')or die("Error Occurred-".mysql_error());
	//mysql_select_db("sarcoix_demo",$con);
	
     $con = mysql_connect('airlinedbinstance.cpvbq348bwqb.us-west-2.rds.amazonaws.com','anushapaida','makmliners')or die("Error Occurred-".mysql_error());
	 mysql_select_db("123ewireless",$con);
	
	//echo($_POST['firstname']);
	
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$tmpname = $_FILES['profilepic']['tmp_name'];
    $description = $_POST['Description'];
    $type = $_FILES['profilepic']['type'];
	$notes = $_POST['Notes'];
	
	($profilepic = fopen($tmpname, 'r')) || die("Please select an image.");;
    $data = fread($profilepic,filesize($tmpname));
    $pic = base64_encode($data);
	
	$sql = "insert into Users(firstname,lastname) values('$firstname','$lastname')";                                                                    
    $query = mysql_query($sql,$con) or die(mysql_error());
	$userid = mysql_insert_id();
	
	$sql1 = "insert into Notes(userid,mytimestamp,note) values('$userid',NOW(),'$notes' )";
	$query1 = mysql_query($sql1,$con) or die(mysql_error());
	$noteid = mysql_insert_id();
	
	$sql2 = "insert into Images(userid,noteid,profilepicture,description) values('$userid','$noteid','$pic','$description')";
	$query2 = mysql_query($sql2,$con);
	}
	
?>
	</form>
</body>
</html>