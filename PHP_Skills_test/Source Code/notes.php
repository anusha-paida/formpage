
<html>
<head>
<title>User Notes</title>
<style>
#table {
	font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
	width: 100%;
	border-collapse: collapse;
}

#table td, #table th {
	font-size: 1em;
	border: 1px solid #98bf21;
	padding: 3px 7px 2px 7px;
}

#table th {
	font-size: 1.1em;
	text-align: left;
	padding-top: 5px;
	padding-bottom: 4px;
	background-color: #A7C942;
	color: #ffffff;
}

#table tr.alt td {
	color: #000000;
	background-color: #EAF2D3;
}
p  {
    color:green;
    font-family:verdana;
    font-size:160%;
}
b4 {
	color: green;
	font-family: arial;
	font-size: 16px;
}
#Header {
	background-color:#A7C942;
	color:white;
	text-align:center;
	padding:6px;
	}
</style>
<h1 id = "Header">Notes</h1>
</head>
<body>

	<form action="notes.php" method="post" enctype="multipart/form-data">




<b4> Add Notes </b4>
<?php
		//$con = mysql_connect('98.130.0.108','sarcoix_demouser','1UserLogin')or die("Error Occurred-".mysql_error());
		//mysql_select_db("sarcoix_demo",$con);
		
		$con = mysqli_connect('airlinedbinstance.cpvbq348bwqb.us-west-2.rds.amazonaws.com','anushapaida','makmliners')or die("Error Occurred-".mysql_error());
	    mysqli_select_db($con,"123ewireless");
		$sql1 = "SELECT * FROM Users";
		$result1 = mysqli_query($con, $sql1);
		while($row1 = mysqli_fetch_assoc($result1)) {
		echo ("<select name='users'>");
		echo("<option value=". $row1['id'].">" . $row1['firstname']. "</option>");
		echo("</select>");
			}
		
?>
		<br> <br>
		<table border="0">
			<tr> 
				<td>
				<input name="data" accept = "image/jpeg" type="file"/><br><br></td>
			</tr>
		
		<b4> Notes </b4>
	
			<tr>
				<td>
				<input type="text" name="newnotes" style="width:500px;height:100px; border:1px solid black"/><br></td>
			</tr>		
		</table>
		<input type="submit" value="Submit" name = "submit">
		<br>
		<p><b>Notes by User</b></p>

		<table id="table">
			<tr>
				<th></th>
				<th>ID</th>
				<th>Username</th>
				<th>Note</th>
				<th>Time</th>
			</tr>

<?php

	//$con = mysql_connect('98.130.0.108','sarcoix_demouser','1UserLogin')or die("Error Occurred-".mysql_error());
	//mysql_select_db("sarcoix_demo",$con);
	if(isset($_POST['submit'])){
		//echo "i am here";
		$tmpname = $_FILES['data']['tmp_name'];
		$newnotes = $_POST['newnotes'];
		$userid = $_POST['users'];
		($fp = fopen($tmpname, 'r')) || die("Please select an image.");;
        $data = fread($fp,filesize($tmpname));
        $pic = base64_encode($data);
		
		$sql2 = "insert into Notes(userid,mytimestamp,note) values('$userid',NOW(),'$newnotes' )";
		$query2 = mysqli_query($con, $sql2) or die(mysql_error());
		$noteid = mysqli_insert_id($con);
	
		$sql3 = "insert into Images(userid,noteid,profilepicture) values('$userid','$noteid','$pic')";
		$query3 = mysqli_query($con, $sql3);
	}
	$sql = "SELECT  Notes.id, CONCAT(Users.firstname, ' ' ,Users.lastname) AS 'Username', Notes.mytimestamp,Notes.note FROM Notes inner join Users on Notes.userid = Users.id";
	$result = mysqli_query($con, $sql);

	if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
		echo ("<tr>");
		echo("<th></th>");
		echo("<th>".$row['id']."</th>");
		echo("<th>".$row['Username']."</th>");
		echo("<th>".$row['note']."</th>");
		echo("<th>".$row['mytimestamp']."</th>");
		echo("</tr>");

    }
	echo ("</TABLE>");
} else {
    echo "0 results";
}
?>
	</form>

</body>
</html>