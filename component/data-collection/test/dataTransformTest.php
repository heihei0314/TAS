<?php
    
    //initial summary data 
    $t=0;
    $s=0;
    $f=0;
    
    //activate test 
    include '../dataTransform.php';
    $dataTransform = new dataTransform();
    
    require_once __DIR__.'/../../resource/controller.php';
    $controller = new Controller();
    $gameData = array();
    foreach ($athletesTest as $athlete){
        $data = $controller->getGameData($athlete);
        array_push($gameData,$data);
    }  
    print_r($gameData);
    //test stub data transformation
    
    //stub athletes data for test
    $athletesTest1 = Array();
    $athletesTest2 = Array("Lam Ching Ho");
    $athletesTest3 = Array("Kong Hin Sing");
    $athletesTest = Array($athletesTest1,$athletesTest2,$athletesTest3);
    //print_r($athletesTest);
    
    $expectedWinlose = Array("","Win","Lose","Lose","Win");
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
        
        require_once __DIR__.'/../../resource/controller.php';
        $controller = new Controller();
        $mappedData = array();
        $testWinlose=array();
        foreach ($athletesTest as $athlete){
            $dataTransform->transformData($athlete);
            $gameData = $controller->getGameData($athlete);
            array_push($testWinlose,$gameData);
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
