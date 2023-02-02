<?php
    include '../component/data-collection/dataCollection.php';
    $dataCollection = new dataCollection();
    $gameAPI = $dataCollection->connectAPI('games');
    $athletesAPI = $dataCollection->connectAPI('athletes');
    
    include '../component/data-analyser/dataTransform.php';
    $dataAnalyser = new dataTransform();
    $mappedData = $dataAnalyser->transformData($gameAPI, $athletesAPI);
    //print_r($mappedData);
    
    // Create Array and convert to JSON
    $json = json_encode($mappedData);
    
    // Set header to JSON format
    header('Content-Type: application/json; charset=utf-8');
  
    // return JSON
    echo $json;
    
?>