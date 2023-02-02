<?php
    
    //stub athletes' name for test cases
    $allAthletes = Array("","Dabin LEE","Tae-Joon PARK");
    $gameData1 = Array();
    $gameData2 = Array("name"=>"Dabin LEE","court"=>"P0","color"=>"R","winlose"=>"Win","WinningRound"=>"2","Score"=>"32","Punch"=>"0","Body"=>"6","SpinBody"=>"5","SpinHead"=>"0","Head"=>"0","Warning"=>"0");
    $gameData3 = Array("name"=>"Tae-Joon PARK","court"=>"P0","color"=>"B","winlose"=>"lose","WinningRound"=>"1","Score"=>"15","Punch"=>"0","Body"=>"0","SpinBody"=>"0","SpinHead"=>"3","Head"=>"0","Warning"=>"0");
    $gameData = Array($gameData1,$gameData2,$gameData3);
    
    //activiate test
    analyserTest($allAthletes, $gameData);
    
    //print test report
    summary();
    
    function analyserTest($allAthletes, $data){
        //print_r($allAthletes);
        //print_r($data);
        
        global $testScore;
        $testScore =array();
        
        include "../analyser.php";
        $analyser = new Profile();
        foreach($allAthletes as $athlete){
            $profile = $analyser->calculateMean($athlete, $data);
            array_push($testScore,$profile['Score']);
        }   
    }
    
    function consoleLog($text){
        echo "<script>console.log('".$text."');</script>";
    }
    
    function summary() {
        global $testScore;
        echo "test result: ";
        print_r($testScore);
        echo "<br>";
        echo "<br>";
        $expectedScore = Array(0,32,15);
        echo "expected result: ";
        print_r($expectedScore);
        echo "<br>";
        echo "<br>";
        
        $t=0;
        $s=0;
        $f=0;
        foreach($testScore as $testValue){
            if($testValue==$expectedScore[$t]){
                $s++;
            }
            else{
                $f++;
            }
            $t++;
        }
        $summary = "test cases: ".$t.", success: ".$s.", fail: ".$f;
        print_r($summary);
        consoleLog($summary);
    }
?>