	<?php 
		$name = "";
		$win = "";
		$lose = "";
		$WinningRound = "";
		$Score = "";
		$Punch = "";
		$Body = "";
		$SpinBody = "";
		$SpinHead = "";
		$Head = "";
		$Warning = "";
		
		if(isset($_POST["name"])){
        		$name = $_POST["name"];
			$win = $_POST["win"];
			$lose = $_POST["lose"];
			$WinningRound = $_POST["WinningRound"];
			$Score = $_POST["Score"];
			$Punch = $_POST["Punch"];
			$Body = $_POST["Body"];
			$SpinBody = $_POST["SpinBody"];
			$SpinHead = $_POST["SpinHead"];
			$Head = $_POST["Head"];
			$Warning = $_POST["Warning"];
    		}
		// Establishing Connection with Database
		require_once '../conf/db_configs.php';
		$conn = new mysqli(host, username, password, dbname);
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
		// Establishing Connection with Database
		$sql = "INSERT INTO profile (name, win, lose, WinningRound, Score, Punch, Body, SpinBody, SpinHead, Head, Warning) VALUES ('$name', '$win', '$lose', '$WinningRound', '$Score', '$Punch', '$Body', '$SpinBody', '$SpinHead', '$Head', '$Warning') ON DUPLICATE KEY UPDATE name = '$name'";
			
		if ($conn->query($sql) === TRUE) {
			echo $sql;
		} else {
			echo "Failed";
		}
		
		$conn->close();
	
	?>
