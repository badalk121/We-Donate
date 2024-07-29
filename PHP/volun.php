<?php
$Name = $_POST['name'];
$City = $_POST['city'];
$Email = $_POST['email'];
$Phone = $_POST['phone'];
$Age = $_POST['age'];
$Address = $_POST['address'];
$Reason = $_POST['reason'];
$Gender = $_POST['gender'];

if(!empty($Name)||!empty($City)||!empty($Email)||!empty($Phone)||!empty($Age)||!empty($Address)||!empty($Gender))	{
	$host = "localhost";
	$dbUsername = "id16684379_idon121";
	$dbPassword = "(hC!8jLP4Czu";
	$dbName = "id16684379_wedonate";
	//Creating connection to the database
	$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

	if(mysqli_connect_error())	{
	die('Connect Error('.mysqli_connect_error().')'.mysqli_connect_error());
	} else {
		$SELECT = "SELECT email FROM volunteers WHERE email = ? LIMIT 1";
		$INSERT = "INSERT INTO volunteers (name, city, email, phone, age, address, reason, gender) values (?, ?, ?, ?, ?, ?, ?, ?)";
		//This is the prepare statement
		$stmt = $conn->prepare($SELECT);
		$stmt->bind_param("s", $email);
		$stmt->execute();
		$stmt->bind_result($email);
		$stmt->store_result();
		$rnum = $stmt->num_rows;
		if ($rnum==0)	{
		$stmt->close();
		$stmt= $conn->prepare($INSERT);
		$stmt->bind_param("sssiisss", $Name, $City, $Email, $Phone, $Age, $Address, $Reason, $Gender);
		$stmt->execute();
		ECHO "Registered Successfully";
		}
		else {
		ECHO "Someone has already registered with this E-Mail before. Try Again..";
		}
		$stmt->close();
		$conn->close();
}
}
 else {
	Echo "All fields are required";
	die();
}
?>