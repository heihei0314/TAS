<?php
    $athlete = "Lam Ching Ho";
    if(isset($_POST['athlete'])){
        $athlete = $_POST['athlete'];
    }
    
    /*/change to DB
    include 'controller.php';
    $controller = new Controller();
    $gameData = $controller->getGameData($athlete);
   // print_r($gameData);
    
    include "../component/data-analyser/analyser.php";
    $analyser = new Profile();
    $profile = $analyser->calculateMean($athlete);
    //change to DB*/
    
    // Create connection
    require_once '../conf/db_configs.php';
	$conn = new mysqli(host, username, password, dbname);// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM profile WHERE name='$athlete'";
    $result = $conn->query($sql);
    
    $conn->close();
    $dataArray = array();
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            array_push($dataArray,$row);
            $profile = $row;
        }
    }
    // Create Array and convert to JSON
    $json = json_encode($profile);
    
    // Set header to JSON format
    header('Content-Type: application/json; charset=utf-8');
  
    // return JSON
    echo $json;
    
?>
