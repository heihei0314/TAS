<?php
    $athlete = "";
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

    $sql = "SELECT id, firstname, lastname FROM MyGuests";
    $result = $conn->query($sql);

    $conn->close();

    // Create Array and convert to JSON
    $json = json_encode($result);
    
    // Set header to JSON format
    header('Content-Type: application/json; charset=utf-8');
  
    // return JSON
    echo $json;
    
?>
