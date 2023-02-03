<?php
    $athlete = "";
    if(isset($_POST['athlete'])){
        $athlete = $_POST['athlete'];
    }
    
    //change to Message Queue
    include 'controller.php';
    $controller = new Controller();
    $gameData = $controller->getGameData();
   // print_r($gameData);
    
    include "../component/data-analyser/analyser.php";
    $analyser = new Profile();
    $profile = $analyser->calculateMean($athlete, $gameData);
    //change to Message Queue
    
    // Create Array and convert to JSON
    $json = json_encode($profile);
    
    // Set header to JSON format
    header('Content-Type: application/json; charset=utf-8');
  
    // return JSON
    echo $json;
    
?>