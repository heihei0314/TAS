<?php

    //initial summary data 
    $t=0;
    $s=0;
    $f=0;
    
    //stub athletes name for test (null, one entry data, three entries data)
    $athletesTest = Array("","Lam Ching Ho","Kong Hin Sing");
    $testData = array();
    $testWinlose = array();
    //activate test   
    include '../component/data-collection/dataTransform.php';
    foreach ($athletesTest as $athlete){
        $testData = transformDataTest($athlete);
        array_push($testWinlose,$testData);
        $t++;
    }   
    
    //pring test report
    summary();
    
    // test data transformation
    function transformDataTest($athlete){        
        //transform and insert data
        $dataTransform = new dataTransform();
        $dataTransform->transformData($athlete);      
        
        //get data from db for validate
        require_once __DIR__.'/../resource/controller.php';
        $controller = new Controller();
        $gameData = array();
        $test = array();
        $gameData = $controller->getGameData($athlete);
        foreach ($gameData as $data){
            array_push($test,$data['winlose']);
        }  
        print_r($test);
        return $test;
    }

       
    
    function consoleLog($text){
        echo "<script>console.log('".$text."');</script>";
    }
    
    //pring test report
    function summary() {
        global $t;
        global $s;
        global $f;
        global $testWinlose;
        $i=0;
        $expectedWinlose = Array(array(),array("Win"),array("Lose","Lose","Win"));  
        foreach ($testWinlose as $result){
            print_r($expectedWinlose[$i]);
            if($result==$expectedWinlose[$i]){
                $s++;
                consoleLog('Transform data succeed');
            }
            else{
                $f++;
                consoleLog('Wrong Win Lose data');
            }
            $i++;
        }
        $summary = "test cases: ".$t.", success: ".$s.", fail: ".$f;
        consoleLog($summary);
    }
?>