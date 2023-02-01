<?php
    $athlete = "";
    if(isset($_POST['athlete'])){
        $athlete = $_POST['athlete'];
    }
    
    include 'controller.php';
    $controller = new Controller();
    $gameData = $controller->getGameData();
    
    //print_r($gameData);
    
    include "../component/data-analyser/analyser.php";
    $analyser = new Profile();
    $profile = $analyser->getMean($athlete, $gameData);
    
    // Create Array and convert to JSON
    $json = json_encode($profile);
    
    // Set header to JSON format
    header('Content-Type: application/json; charset=utf-8');
  
    // return JSON
    echo $json;
    

    
    function getData($url){
        //connect to resource
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
          'Content-Type: application/json')
        );

        // get json 
        $result = curl_exec($ch);
        //echo $result;
        curl_close($ch);
        //connect to resource
        $response = json_decode($result, true);
        //echo count($data);
        // get json and convert to array
        return $response;
    }
    
    
?>