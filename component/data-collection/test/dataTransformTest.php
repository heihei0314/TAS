<?php
            //get data from db for validate
        require_once __DIR__.'/../../../resource/controller.php';
        $controller = new Controller();
        $testWinlose=array();
        $testDdata = array();
        foreach ($athletesTest as $athlete){
            $testDdata = $controller->getGameData($athlete);
            array_push($testWinlose,$testData['winlose']);
        }  
        print_r($testWinlose);
    //initial summary data 
    $t=0;
    $s=0;
    $f=0;
    
    //activate test     
    $expectedWinlose = Array("","Win","Lose","Lose","Win");

    //stub athletes name for test (null, one entry data, three entries data)
    $athletesTest = Array("","Lam Ching Ho","Kong Hin Sing");
    print_r($athletesTest);

    $msg = transformDataTest($athletesTest,$expectedWinlose);
    consoleLog($msg);
    
    //pring test report
    summary();
    
    // test data transformation
    function transformDataTest($athletesTest,$expectedWinlose){
        global $t;
        global $s;
        global $f;
        
        include '../dataTransform.php';
        $dataTransform = new dataTransform();
        foreach ($athletesTest as $athlete){
            //transform and insert data
            $dataTransform->transformData($athlete);
            $t++;
        }        
        
        //get data from db for validate
        require_once __DIR__.'/../../../resource/controller.php';
        $controller = new Controller();
        $testWinlose=array();
        $testDdata = array();
        foreach ($athletesTest as $athlete){
            $testDdata = $controller->getGameData($athlete);
            array_push($testWinlose,$testData['winlose']);
        }  
        print_r($testWinlose);
        
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
