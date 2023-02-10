<?php
    use PHPUnit\Framework\TestCase;

    class winRateTest extends \PHPUnit\Framework\TestCase{
        public function testWinRateTestResult(){
            //stub athletes' mean data for test cases
            $meanData1 = Array("name"=>"Dabin LEE","win"=>1,"lose"=>"0","WinningRound"=>"2","Score"=>"32","Punch"=>"0","Body"=>"6","SpinBody"=>"5","SpinHead"=>"0","Head"=>"0","Warning"=>"0");
            $meanData2 = Array("name"=>"Tae-Joon PARK","win"=>0,"lose"=>"1","WinningRound"=>"2","Score"=>"15","Punch"=>"0","Body"=>"0","SpinBody"=>"0","SpinHead"=>"3","Head"=>"0","Warning"=>"0");
            
            //expected result
            $expectedWinRate = Array("86.67%","13.33%");
            require_once __DIR__.'/../component/data-analyser/winRate.php';
            //activiate test
            $winRateAnalyser = new winRateCalculator();
            $winRateTestResult = $winRateAnalyser->getWinRate($meanData1, $meanData2);
            
            $this->assertEquals($expectedWinRate, $winRateTestResult);
    
            $winRateTestResult = array();
        }
    }
?>