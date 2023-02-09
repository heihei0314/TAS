<?php
    use PHPUnit\Framework\TestCase;
    //$IT = new integrationTest();
    //$IT->testApp();
    class integrationTest extends \PHPUnit\Framework\TestCase{
        public function testApp(){
            //1. get athlete name from API
            $allAthletes = $this->testGetAthletes();
            $this->assertGreaterThan(0,count($allAthletes));
            $this->assertEquals("Lam Ching Ho",$testCase1);
            print_r( $allAthletes);echo "<br><br>";

            //2. transform specific athlete game data
            require_once __DIR__.'/../component/data-collection/dataTransform.php';
            $dataTransform = new dataTransform();
            $gameData1 = $dataTransform->transformData($allAthletes[0]);   
            $this->assertEquals(1, count($gameData1));
            print_r(count($gameData1));echo "<br><br>";

            $gameData2 = $dataTransform->transformData($allAthletes[1]);   
            $this->assertEquals(3, count($gameData2));
            print_r(count($gameData2));echo "<br><br>";

            //3. calculate mean for specific athlete with DB
            require_once __DIR__.'/../component/data-analyser/analyser.php';
            $analyser = new Profile();
            $mean1 = $analyser->calculateMean($allAthletes[0]);
            print_r($mean1);echo "<br><br>";
            $this->assertEquals(3, $mean1['Score']);

            $mean1 = $analyser->calculateMean($allAthletes[1]);
            print_r($mean2);echo "<br><br>";
            $this->assertEquals(15, $mean2['Score']);

            //4. calculate win rate from grabed mean data
            require_once __DIR__.'/../component/data-analyser/winRate.php';
            $winRateAnalyser = new winRateCalculator();
            $winRateTestResult = $winRateAnalyser->getWinRate($mean1,$mean2);
            $this->assertEquals(array('0%','100%'), $winRateTestResult);
            print_r($winRateTestResult);echo "<br><br>";

        }
        public function testGetAthletes(){
            require_once __DIR__.'/../resource/controller.php';
            $controller = new Controller();
            $allAthletes = $controller->getAthletes();
            return $allAthletes;
        }

        public function testDataTransform($case){
            $dataset = array();
            require_once __DIR__.'/../component/data-collection/dataTransform.php';
            $dataTransform = new dataTransform();
            $dataset = $dataTransform->transformData($case);   
            
            
            $this->assertEquals(1, $dataset);
            return $dataset;
        }

        public function testGetMean($case){
            require_once __DIR__.'/../component/data-analyser/analyser.php';
            $analyser = new Profile();
            $profile = $analyser->calculateMean($case);
            return $profile;
        }

        public function testGetWinRate($mean1,$mean2){
            require_once __DIR__.'/../component/data-analyser/winRate.php';
            $winRateAnalyser = new winRateCalculator();
            $winRateTestResult = $winRateAnalyser->getWinRate($mean1,$mean2);
            return $winRateTestResult;
        }
    }