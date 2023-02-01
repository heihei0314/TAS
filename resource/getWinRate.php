<?php
    $athlete1 = "Dabin LEE";
    
    $athlete2 = "Tae-Joon PARK";
    if(isset($_POST['athlete1'])){
        $athlete1 = $_POST['athlete1'];
    }
    if(isset($_POST['athlete2'])){
        $athlete2 = $_POST['athlete2'];
    }
    
    include "../component/data-analyser/winRate.php";
    $calculator = new winRateCalculator();
    $winRate = $calculator->getWinRate($athlete1,$athlete2);
    //print_r($winRate);
    // Create Array and convert to JSON
    $json = json_encode($winRate);
    
    // Set header to JSON format
    header('Content-Type: application/json; charset=utf-8');
  
    // return JSON
    echo $json;
    
?>