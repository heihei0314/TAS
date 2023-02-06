<?php
    
    //initial summary data 
    $t=0;
    $s=0;
    $f=0;
    
    //stub athletes data for test (null, one entry data, three entries data)
    $athletesTest = Array("","Lam Ching Ho","Kong Hin Sing");
    print_r($athletesTest);

    //activate test 
    include '../dataTransform.php';
    $dataTransform = new dataTransform();
    
    require_once __DIR__.'/../../../resource/controller.php';
    $controller = new Controller();
    $gameData = array();
    foreach ($athletesTest as $athlete){
        $data = $controller->getGameData($athlete);
        array_push($gameData,$data);
    }  
    print_r($gameData);
    //test stub data transformation
    

    
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
        
        $testWinlose=array();
        foreach ($athletesTest as $athlete){
            $dataTransform->transformData($athlete);
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
