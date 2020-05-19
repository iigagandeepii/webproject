<?php
	$uname = $_POST['uid'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];

	if(!empty($uname) || !empty($email) || !empty($phone))
	{
		$host = 'localhost';
		$dbuname = 'root';
		$dbpwd = "";
		$dbname = "xyz";

		$conn = new mysqli($host,$dbuname,$dbpwd,$dbname);
		if (mysqli_connect_error()) {
			die('Connect Error');
		}
		else {
			$select = "select email from login where email=? limit 1";
			$insert = "insert into login (userid, email, phone) values(?,?,?)";

			$stmt = $conn -> prepare($select);
			$stmt -> bind_param("s",$email);
			$stmt -> store_result($email);
			$rnum = $stmt -> num_rows;

			if($rnum == 0){
				$stmt -> close();
				$stmt -> bind_param("sss",$uname,$email,$phone);
				$stmt -> execute();
				echo "New record inserted successfully !";
			}
			else{
				echo "Someone has already used email. GO back and try again !";
			}
			$stmt->close();
			$conn->close();
		}
		
	}
	else
	{
		echo "All fields required";
		die();
	}
?>