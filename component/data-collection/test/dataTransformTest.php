<?php
    
    //initial summary data 
    $t=0;
    $s=0;
    $f=0;
    
    //activate test 
    include '../dataTransform.php';
    $dataTransform = new dataTransform();

    
    //test stub data transformation
    
    //stub athletes data for test
    $athletesTest1 = Array();
    $athletesTest2 = Array("Lam Ching Ho");
    $athletesTest3 = Array("Kong Hin Shing");
    $athletesTest = Array($athletesTest1,$athletesTest2,$athletesTest3);
    //print_r($athletesTest);
    
    $expectedWinlose = Array("","Lose","Win","Win","Lose");
    $msg = transformDataTest($athletesTest,$expectedWinlose);
    consoleLog($msg);
    
    //pring test report
    summary();
    
    // test data transformation
    function transformDataTest($athletesTest,$expectedWinlose){
        global $t;
        global $s;
        global $f;
        global $dataTransform;
        $t++;
        
        $mappedData = array();
        $testWinlose=array();
        foreach ($athletesTest as $athlete){
            $profile = $dataTransform->transformData($athlete);
            array_push($mappedData, $profile); 
            array_push($testWinlose,$profile['winlose']);
        }        
        
        if($testWinlose==$expectedWinlose){
            $s++;
            $msg = 'Transform data succeed';
        }
        else{
            $f++;
            $msg = 'Wrong Win Lose data';
        }
        return $msg;
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