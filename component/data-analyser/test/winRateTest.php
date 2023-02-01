<?php
    
    //stub athletes' mean data for test cases
    $athlete1 = "Dabin LEE";
    $athlete2 = "Tae-Joon PARK";
    $athletes=array();
    array_push($athletes,$athlete1);
    array_push($athletes,$athlete2);
    
    
    $meanData1 = Array("name"=>"Dabin LEE","court"=>"P0","color"=>"R","winlose"=>"Win","WinningRound"=>"2","Score"=>"32","Punch"=>"0","Body"=>"6","SpinBody"=>"5","SpinHead"=>"0","Head"=>"0","Warning"=>"0");
    $meanData2 = Array("name"=>"Tae-Joon PARK","court"=>"P0","color"=>"B","winlose"=>"lose","WinningRound"=>"1","Score"=>"15","Punch"=>"0","Body"=>"0","SpinBody"=>"0","SpinHead"=>"3","Head"=>"0","Warning"=>"0");
    $meanData=array();
    array_push($meanData,$meanData1);
    array_push($meanData,$meanData2);
    
    //activiate test
    $winRateTestResult = array();
    winRateTest($athletes, $meanData);
    
    //print test report
    summary();
    
    function winRateTest($athletes, $meanData){
        //print_r($allAthletes);
        //print_r($data);
        
        global $winRateTestResult;
        include "../winRate.php";
        $winRateAnalyser = new winRateCalculator();
        $winRateTestResult = $winRateAnalyser->getWinRate($athletes[0], $athletes[1]);
    }
    
    function consoleLog($text){
        echo "<script>console.log('".$text."');</script>";
    }
    
    function summary() {
        global $winRateTestResult;
        print_r($winRateTestResult);
        $expectedWinRate = Array(0,32,15);
        $t=1;
        $s=0;
        $f=0;
        if($winRateTestResult[0]==$expectedWinRate[0]&&$winRateTestResult[0]==$expectedWinRate[0]){
            $s++;
        }
        else{
            $f++;
        }
        $summary = "test cases: ".$t.", success: ".$s.", fail: ".$f;
        consoleLog($summary);
    }
?>