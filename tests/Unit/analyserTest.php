<?php
    namespace Tests\Unit;
    
    use PHPUnit\Framework\TestCase;
    use App\Http\Controllers;
    use App\Models\dataCollection\dataCollection;
    use App\Models\dataAnalyser\dataAnalyser;
    use App\Models\dataAnalyser\winRateCalculator;
    
    class analyserTest extends TestCase {
        private $dataCollector;
        private $dataAnalyser;
        private $winRateCalculator;
        public function __construct(dataCollection $dataCollection, dataAnalyser $dataAnalyser, winRateCalculator $winRateCalculator)
        {
            $this->dataCollector = $dataCollection;
            $this->dataAnalyser = $dataAnalyser;
            $this->winRateCalculator = $winRateCalculator;
        }
        
        public function testCalculator(){
            //stub athletes' name for test cases
            $allAthletes = Array("","Lam Ching Ho","Kong Hin Sing");
            $gameData1 = Array();
            $gameData2 = Array(Array("name"=>"Lam Ching Ho","court"=>"P0","color"=>"R","winlose"=>"Win","WinningRound"=>"2","Score"=>"32","Punch"=>"0","Body"=>"6","SpinBody"=>"5","SpinHead"=>"0","Head"=>"0","Warning"=>"0"));
            $gameData3 = Array(Array("name"=>"Kong Hin Sing","court"=>"P0","color"=>"B","winlose"=>"lose","WinningRound"=>"1","Score"=>"15","Punch"=>"0","Body"=>"0","SpinBody"=>"0","SpinHead"=>"3","Head"=>"0","Warning"=>"0"),Array("name"=>"Kong Hin Sing","court"=>"P0","color"=>"R","winlose"=>"Win","WinningRound"=>"2","Score"=>"11","Punch"=>"0","Body"=>"6","SpinBody"=>"5","SpinHead"=>"0","Head"=>"0","Warning"=>"0"));
            $gameData = Array($gameData1,$gameData2,$gameData3);
            //expected result
            $expectedScore = Array(0,32,13);
        
            //activiate test
            $i=0;
            $profile = array();
            $testA = array();
            $testScore = array();
            foreach($allAthletes as $athlete){
                $profile = $this->dataAnalyser->mean($athlete);
                $i++;
                array_push($testA,$athlete);
                array_push($testScore,$profile['Score']);
            }   
            $this->assertEquals($expectedScore, $testScore);
        }
    }

?>
