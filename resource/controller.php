<?php
    
Class Controller{
    function getAthletes(){
        $athletesURL = "http://tas.waitsuentkd.com/resource/getAthletes.php";
        $data=array();
        $allAthletes = $this->gateway($athletesURL,$data);
        return $allAthletes;
    }
    
    function getGameData($athlete){
        $gameURL = "http://tas.waitsuentkd.com/resource/getGameData.php";
        $athleteData = array('athlete' => $athlete);
        $gameData = $this->gateway($gameURL, $athleteData);
        return $gameData;
    }
    
    function putGameData($gameData){
        $putGameDataURL = "http://tas.waitsuentkd.com/resource/putGameData.php";
        $this->gateway($putGameDataURL, $gameData);          
    }

    function getDBGameData(){
        //db
        return $gameData;
    }     

    function putMean($profile){
        $putMeanURL = "http://tas.waitsuentkd.com/resource/putMean.php";
        $this->gateway($putMeanURL, $profile);        
    }

    function getMean($athlete){
        $meanURL = "http://tas.waitsuentkd.com/resource/getMean.php";
        $athleteData = array('athlete' => $athlete);
        $meanData = $this->gateway($meanURL, $athleteData);
        return $meanData;
    }
    
    function putWinRate($WinRate){
        $putWinRateURL = "http://tas.waitsuentkd.com/resource/putWinRate.php";
        $this->gateway($putWinRateURL, $WinRate);        
    }
    
    function getWinRate($meanData1,$meanData2){
        $winRateURL = "http://tas.waitsuentkd.com/resource/getWinRate.php";
        $meanDataArray = array('meanData1' => $meanData1, 'meanData2' => $meanData2);
        $winRateData = $this->gateway($winRateURL, $meanDataArray);
        return $winRateData;
    }
    
    function gateway($url, $data){
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
