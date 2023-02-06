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
    foreach ($athletesTest as $athlete){
        $testData = transformDataTest($athlete);
        array_push($testWinlose,$testData);
        $t++;
    }   
    
    
    //pring test report
    summary();
    
    // test data transformation
    function transformDataTest($athlete){        
        include '../dataTransform.php';
        $dataTransform = new dataTransform();
        foreach ($athletesTest as $athlete){
            //transform and insert data
            $dataTransform->transformData($athlete);
        }        
        
        //get data from db for validate
        require_once __DIR__.'/../../../resource/controller.php';
        $controller = new Controller();
        $gameData = array();
        $test = array();
        foreach ($athletesTest as $athlete){
            $gameData = $controller->getGameData($athlete);
            foreach ($gameData as $data){
                array_push($test,$data['winlose']);
            }
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
        $expectedWinlose = Array(array(""),array("Win"),array("Lose","Lose","Win"));  
        foreach ($testWinlose as $result){
            if($result==$expectedWinlose){
                $s++;
                consoleLog('Transform data succeed');
            }
            else{
                $f++;
                consoleLog('Wrong Win Lose data');
            }
        }
        $summary = "test cases: ".$t.", success: ".$s.", fail: ".$f;
        consoleLog($summary);
    }
?>
