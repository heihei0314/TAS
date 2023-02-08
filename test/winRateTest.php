<?php
    
    //stub athletes' mean data for test cases
    $meanData1 = Array("name"=>"Dabin LEE","win"=>1,"lose"=>"0","WinningRound"=>"2","Score"=>"32","Punch"=>"0","Body"=>"6","SpinBody"=>"5","SpinHead"=>"0","Head"=>"0","Warning"=>"0");
    $meanData2 = Array("name"=>"Tae-Joon PARK","win"=>0,"lose"=>"1","WinningRound"=>"2","Score"=>"15","Punch"=>"0","Body"=>"0","SpinBody"=>"0","SpinHead"=>"3","Head"=>"0","Warning"=>"0");
    $meanData=array();
    array_push($meanData,$meanData1);
    array_push($meanData,$meanData2);
    
    //activiate test
    $winRateTestResult = array();
    winRateTest($meanData1, $meanData2);
    
    //print test report
    summary();
    
    function winRateTest($meanData1,$meanData2){
        //print_r($allAthletes);
        //print_r($data);
        
        global $winRateTestResult;
        include "../winRate.php";
        $winRateAnalyser = new winRateCalculator();
        $winRateTestResult = $winRateAnalyser->getWinRate($meanData1, $meanData2);
    }
    
    function consoleLog($text){
        echo "<script>console.log('".$text."');</script>";
    }
    
    function summary() {
        global $winRateTestResult;
        print_r($winRateTestResult);
        $expectedWinRate = Array("46.43%","53.57%");
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