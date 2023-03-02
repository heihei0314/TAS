<?php
    namespace Tests\Unit;
    use PHPUnit\Framework\TestCase;
    use App\Models\dataAnalyser\winRateCalculator;
    
    class winRateTest extends TestCase{
        public function testWinRateTestResult(){
            //stub athletes' mean data for test cases
            $meanData1 = Array("name"=>"Dabin LEE","win"=>1,"lose"=>"0","WinningRound"=>"2","Score"=>"32","Punch"=>"0","Body"=>"6","SpinBody"=>"5","SpinHead"=>"0","Head"=>"0","Warning"=>"0");
            $meanData2 = Array("name"=>"Tae-Joon PARK","win"=>0,"lose"=>"1","WinningRound"=>"2","Score"=>"15","Punch"=>"0","Body"=>"0","SpinBody"=>"0","SpinHead"=>"3","Head"=>"0","Warning"=>"0");
            
            //expected result
            $winRateCalculator = $this->winRateCalculator;
            //activiate test
            $winRateTestResult = $winRateCalculator->getWinRate($meanData1, $meanData2);
            
            $this->assertEquals($expectedWinRate, $winRateTestResult);
    
            $winRateTestResult = array();
        }
    }
?>