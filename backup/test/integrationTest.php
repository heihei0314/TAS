<?php
    use PHPUnit\Framework\TestCase;
    //$IT = new integrationTest();
    //$IT->testApp();
    class integrationTest extends \PHPUnit\Framework\TestCase{
        public function testApp(){
            //1. get athlete name from API
            require_once __DIR__.'/../resource/controller.php';
            $controller = new Controller();
            $allAthletes = $controller->getAthletes();
            $this->assertGreaterThan(0,count($allAthletes));
            $this->assertEquals("Lam Ching Ho",$allAthletes[0]);
            print_r($allAthletes);echo "<br><br>";

            //2. transform game data with grabed athlete name
            require_once __DIR__.'/../component/data-collection/dataTransform.php';
            $dataTransform = new dataTransform();
            $gameData1 = $dataTransform->transformData($allAthletes[0]);   
            $this->assertEquals(1, count($gameData1));
            print_r(count($gameData1));echo "<br><br>";

            $gameData2 = $dataTransform->transformData($allAthletes[1]);   
            $this->assertEquals(3, count($gameData2));
            print_r(count($gameData2));echo "<br><br>";

            //3. calculate mean with grabed athlete name from DB
            require_once __DIR__.'/../component/data-analyser/analyser.php';
            $analyser = new Profile();
            $mean1 = $analyser->calculateMean($allAthletes[0]);
            print_r($mean1);echo "<br><br>";
            $this->assertEquals(3, $mean1['Score']);

            $mean2 = $analyser->calculateMean($allAthletes[1]);
            print_r($mean2);echo "<br><br>";
            $this->assertEquals(15, $mean2['Score']);

            //4. calculate win rate from grabed mean data
            require_once __DIR__.'/../component/data-analyser/winRate.php';
            $winRateAnalyser = new winRateCalculator();
            $winRateTestResult = $winRateAnalyser->getWinRate($mean1,$mean2);
            $this->assertEquals(array('0%','100%'), $winRateTestResult);
            print_r($winRateTestResult);echo "<br><br>";

        }
    }