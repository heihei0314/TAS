<?php
    $athlete = "";
    if(isset($_POST['athlete'])){
        $athlete = $_POST['athlete'];
    }
    
    //change to DB
    include '../component/data-collection/dataCollection.php';
    $dataCollection = new dataCollection();
    $gameAPI = $dataCollection->connectAPI('games');
    $athletesAPI = $dataCollection->connectAPI('athletes');
    
    include '../component/data-analyser/dataTransform.php';
    $dataAnalyser = new dataTransform();
    $mappedData = $dataAnalyser->transformData($gameAPI, $athletesAPI);
    //print_r($mappedData);
    //change to DB

    // Create Array and convert to JSON
    $json = json_encode($mappedData);
    
    // Set header to JSON format
    header('Content-Type: application/json; charset=utf-8');
  
    // return JSON
    echo $json;
    
?>