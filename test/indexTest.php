<?php
    $testCase = array();
    
    // stub url
    $testURL = array("","https://tas.waitsuentkd.com/");
    
    //activiate unit test
    foreach ($testURL as $url){
        respondTest($url);
    }
    summary();
    
    // test HTTP Response 
    function respondTest($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        $rt = curl_exec($ch);
        $info = curl_getinfo($ch);
        $http_status = $info["http_code"];
        
        global $testCase;
        if($http_status != '200') {
            $status = "HTTP Response: Error, ".$http_status;
            array_push($testCase,0);
        }
        else{
            $status = "HTTP Response: OK, ".$http_status;
            array_push($testCase,1);
        }
        consoleLog($status);
    }    

    // print console log;
    function consoleLog($text){
        echo "<script>console.log('".$text."');</script>";
    }
    
    function summary() {
        global $testCase;
        //print_r($testCase);
        $expectedCase = Array(0,1);
        //print_r($expectedCase);
        $t=0;
        $s=0;
        $f=0;
        foreach($testCase as $testValue){
            if($testValue==$expectedCase[$t]){
                $s++;
            }
            else{
                $f++;
            }
            $t++;
        }
        $summary = "test cases: ".$t.", success: ".$s.", fail: ".$f;
        consoleLog($summary);
    }

?>