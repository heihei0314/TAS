<?php
        
Class Controller{
    function getAthletes(){
        $athletesURL = "https://tas.waitsuentkd.com/resource/getAthletes.php";
        $allAthletes = $this->get($athletesURL);
        return $allAthletes;
    }
    
    function getGameData(){
        $gameURL = "https://tas.waitsuentkd.com/resource/getGameData.php";
        $gameData = $this->get($gameURL);
        return $gameData;
    }
    
    function getMean($athlete){
        $meanURL = "https://tas.waitsuentkd.com/resource/getMean.php";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $meanURL);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
            "athlete=".$athlete); 
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
    
    function getwinRate($athlete1,$athlete2){
        $winRateURL = "https://tas.waitsuentkd.com/resource/getWinRate.php";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $winRateURL);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
            "athlete1=".$athlete1."athlete2=".$athlete2); 
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
    
    function get($url){
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
}
?>