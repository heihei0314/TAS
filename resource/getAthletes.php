<?php
    include '../component/data-collection/dataCollection.php';
    $dataCollection = new dataCollection();
    $API = $dataCollection->connectAPI('athletes');
    //print_r($API);
    
    $athletes = array();
    foreach ($API as $value){
        array_push($athletes,$value['name']);
    }
    // Create Array and convert to JSON
    $json = json_encode($athletes);
    
    // Set header to JSON format
    header('Content-Type: application/json; charset=utf-8');
  
    // return JSON
    echo $json;
    
?>