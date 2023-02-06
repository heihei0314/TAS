<?php
    $athlete = "";
    if(isset($_POST['athlete'])){
        $athlete = $_POST['athlete'];
    }
    
    require_once '../conf/db_configs.php';
    $conn = new mysqli(host, username, password, dbname);// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM profile WHERE name='$athlete'";
    $result = $conn->query($sql);
    
    $conn->close();
    $profile = array('name' => $athlete,'win' => 0,'lose' => 0,	'WinningRound' =>0,'Score' =>0,'Punch' =>0,'Body' =>0,'SpinBody' =>0,'SpinHead' =>0,'Head' =>0,'Warning' =>0);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
		$profile= $row;
        }
    }
    // Create Array and convert to JSON
    $json = json_encode($profile);
    
    // Set header to JSON format
    header('Content-Type: application/json; charset=utf-8');
  
    // return JSON
    echo $json;
    
?>
