<?php
    
    $athlete1 = "";
    $athlete2 = "";
    if(isset($_POST['athlete1'])){
        $athlete1 = $_POST['athlete1'];
    }
    if(isset($_POST['athlete2'])){
        $athlete2 = $_POST['athlete2'];
    }
    
   // print_r($meanData2);
    include "controller.php";
    $controller = new Controller();
    $meanData1 = $controller->getMean($athlete1);
    $meanData2 = $controller->getMean($athlete2);
    //print_r($meanData1);
    
    include "../component/data-analyser/winRate.php";
    $calculator = new winRateCalculator();
    $winRate = $calculator->getWinRate($meanData1,$meanData2);
    
    // Create Array and convert to JSON
    $json = json_encode($winRate);
    
    // Set header to JSON format
    header('Content-Type: application/json; charset=utf-8');
  
    // return JSON
    echo $json;
    
?>