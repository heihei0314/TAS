<?php
    namespace Tests\Unit;
    use PHPUnit\Framework\TestCase;
    
    use App\Models\dataCollection\dataCollection;
    use App\Models\dataAnalyser\dataAnalyser;
    use App\Models\dataAnalyser\winRateCalculator;
    
    class integrationTest extends \PHPUnit\Framework\TestCase{
    private $dataCollector;
    private $dataAnalyser;
    private $winRateCalculator;
    public function __construct(dataCollection $dataCollection, dataAnalyser $dataAnalyser, winRateCalculator $winRateCalculator)
    {
        $this->dataCollector = $dataCollection;
        $this->dataAnalyser = $dataAnalyser;
        $this->winRateCalculator = $winRateCalculator;
    }
    public function testApp(){
            //1. get athlete name from API
            $controller = $this->dataCollector;
            $allAthletes = $controller->getAthletes();
            $this->assertGreaterThan(0,count($allAthletes));
            $this->assertEquals("Lam Ching Ho",$allAthletes[0]);
            print_r($allAthletes);echo "<br><br>";

            //2. transform game data with grabed athlete name
            $dataTransform = $this->dataCollector;
            $gameData1 = $dataTransform->getGameData($allAthletes[0]);   
            $this->assertEquals(1, count($gameData1));
            print_r(count($gameData1));echo "<br><br>";

            $gameData2 = $dataTransform->getGameData($allAthletes[1]);   
            $this->assertEquals(3, count($gameData2));
            print_r(count($gameData2));echo "<br><br>";

            //3. calculate mean with grabed athlete name from DB
            $mean1 = $this->dataAnalyser->mean($allAthletes[0]);
            print_r($mean1);echo "<br><br>";
            $this->assertEquals(3, $mean1['Score']);

            $mean2 = $this->dataAnalyser->mean($allAthletes[1]);
            print_r($mean2);echo "<br><br>";
            $this->assertEquals(15, $mean2['Score']);

            //4. calculate win rate from grabed mean data
            $winRateTestResult =$this->winRateCalculator->winRate($mean1,$mean2);
            $this->assertEquals(array('0%','100%'), $winRateTestResult);
            print_r($winRateTestResult);echo "<br><br>";

        }
    }