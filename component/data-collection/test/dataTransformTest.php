<?php
    
    //initial summary data 
    $t=0;
    $s=0;
    $f=0;
    
    //activate test 
    include '../dataTransform.php';
    $dataTransform = new dataTransform();

    
    //test stub data transformation
    //stub game data for test
    $gameTest1 = Array();
    $gameTest2 = Array( "court" => "P0", "gameWinner" => "R", "rWinningRound" => 2, "bWinningRound" => 1, "RScore" => 32, "RPunch" => 0, "RBody" => 6, "RSpinBody" => 5, "RSpinHead" => 0, "RHead" => 0, "RWarning" => 0, "blueScore" => 15, "BPunch" => 0, "BBody" => 0, "BSpinBody" => 0, "BSpinHead]" => 3, "BHead" => 0, "BWarning" => 0 );
    $gameTest3 = Array( "court" => "P1", "gameWinner" => "R", "rWinningRound" => 2, "bWinningRound" => 1, "RScore" => 15, "RPunch" => 0, "RBody" => 0, "RSpinBody" => 0, "RSpinHead" => 0, "RHead" => 3, "RWarning" => 1, "blueScore" => 1, "BPunch" => 0, "BBody" => 0, "BSpinBody" => 0, "BSpinHead]" => 0, "BHead" => 0, "BWarning" => 0 );
    $gameTest = Array($gameTest1,$gameTest2,$gameTest3);
    //print_r($gameTest);
    
    //stub athletes data for test
    $athletesTest1 = Array();
    $athletesTest2 = Array("name"=>"Dabin LEE","court"=>"P0","Color"=>"B");
    $athletesTest3 = Array("name"=>"Tae-Joon PARK","court"=>"P0","Color"=>"R");
    $athletesTest4 = Array("name"=>"Dabin LEE","court"=>"P1","Color"=>"R");
    $athletesTest5 = Array("name"=>"Jun JANG","court"=>"P1","Color"=>"B");
    $athletesTest = Array($athletesTest1,$athletesTest2,$athletesTest3,$athletesTest4,$athletesTest5);
    //print_r($athletesTest);
    
    $expectedWinlose = Array("","Lose","Win","Win","Lose");
    $msg = transformDataTest($gameTest, $athletesTest,$expectedWinlose);
    consoleLog($msg);
    
    //pring test report
    summary();
    
    // test data transformation
    function transformDataTest($gameTest,$athletesTest,$expectedWinlose){
        global $t;
        global $s;
        global $f;
        global $dataTransform;
        $t++;
        
        $mappedData = $dataTransform->transformData($athletesTest);
        $testWinlose=array();
        foreach ($mappedData as $value){
            array_push($testWinlose,$value['winlose']);
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