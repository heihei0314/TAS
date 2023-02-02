<?php
    
Class Controller{
    function getAthletes(){
        $athletesURL = "https://tas.waitsuentkd.com/resource/getAthletes.php";
        $data=array();
        $allAthletes = $this->get($athletesURL,$data);
        return $allAthletes;
    }
    
    function getGameData(){
        $gameURL = "https://tas.waitsuentkd.com/resource/getGameData.php";
        $data=array();
        $gameData = $this->get($gameURL,$data);
        return $gameData;
    }
    
    function postGameData(){
        
    }
    
    function postMean(){
        
    }
    
    function getMean($athlete){
        $meanURL = "https://tas.waitsuentkd.com/resource/getMean.php";
        $athleteData = array('athlete' => $athlete);
        $meanData = $this->get($meanURL, $athleteData);
        return $meanData;
    }
    
    function getwinRate($meanData1,$meanData2){
        $winRateURL = "https://tas.waitsuentkd.com/resource/getWinRate.php";
        $meanDataArray = array('meanData1' => $meanData1, 'meanData2' => $meanData2);
        $winRateData = $this->get($winRateURL, $meanDataArray);
        return $winRateData;
    }
    
    function get($url, $data){
        //connect to resource
        if(count($data)==0)
        {
            $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded"
                )
            );
        }
        else {
            $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded",
                'method'  => 'POST',
                'content' => http_build_query($data)
                )
            );
        }
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        //connect to resource
        
        $response = json_decode($result, true);
        //echo count($data);
        // get json and convert to array
        return $response;
    }
}
?>