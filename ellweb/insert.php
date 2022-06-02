<?php
//$Name = $_POST['FullName'];
//$Phone = $_POST['Phone'];
//$Email = $_POST['Email'];
//$Date = $_POST['AppointmentDate'];
//$Time = $_POST['Time'];
//$Message = $_POST['Message'];
if (isset($_POST['appointment'])) {
	echo "action here";
}
if (!empty($Name) || !empty($Phone) || !empty($Email) || !empty($Date) || !empty($Time) || !empty($Message)){
	$host = "localhost";
	$dbUsername = "root";
	$dbPassword = "";
	$dbname = "ell";
	// create connection
	$conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
	if (mysqli_connect_error()) {
		// code...
		die('Connect Error('. mysqli_errno().')'.mysqli_connect_error());}
		else{
			$SELECT = "SELECT email From register where email= ? Limit 1";
			$INSERT = "INSERT Into register (Name, Phone, Email, Date, Time, Message) values(?, ?, ?, ?, ?, ?)";
			//prepare statement
			$stmt = $conn->prepare($SELECT);
			$stmt->bind_param("s", $Email);
			$stmt->execute();
			$stmt->bind_result($Email);
			$stmt->store_result();
			$rnum = $stmt->num_rows;
			if ($rnum==0) {
				$stmt->close();
				$stmt = $conn->prepare($INSERT);
				$stmt->bind_param("ssssii", $Name, $Phone, $Email, $Date, $Time, $Message);
				$stmt->execute();
				echo "New Record Inserted Succesfully";
			}
			$stmt->close();
			$stmt->close();
			}
		}		
 else{

	die();
}
?>