<?php
    
    //initial summary data 
    $t=0;
    $s=0;
    $f=0;
    
    //activate test 
    include '../dataCollection.php';
    $dataCollection = new dataCollection();
    
    //test public API connection
    $testAPI = connectAPITest();
    
    
    //pring test report
    summary();
    
    // test public API connection
    function connectAPITest(){
        global $t;
        global $s;
        global $f;
        global $dataCollection;
        
        $testGameAPI = $dataCollection->connectAPI('games');
        $testAthletesAPI = $dataCollection->connectAPI('athletes');
        $t++;
        if (is_null($testGameAPI) || is_null($testAthletesAPI)){
            $f++;
            consoleLog('API connect failed');
        }
        else{
            $s++;
        }
        $testAPI = array();
        array_push($testAPI,$testGameAPI);
        array_push($testAPI,$testAthletesAPI);
        return $testAPI;
    }
    
    function consoleLog($text){
        echo "<script>console.log('".$text."');</script>";
    }
    
    //pring test report
    function summary() {
        global $t;
        global $s;
        global $f;
        
        $summary = "test cases: ".$t.", success: ".$s.", fail: ".$f;
        consoleLog($summary);
    }
?>