<?php
    use PHPUnit\Framework\TestCase;

    class integrationTest extends \PHPUnit\Framework\TestCase{
        public function getAthletes(){
            require_once __DIR__.'/../resource/controller.php';
            $controller = new Controller();
            $allAthletes = $controller->getAthletes();
            $this->assertGreaterThan(0,count($response));
            $this->assertEquals("Lam Ching Ho",$testCase1);
            $testCase1 = $response[0]['name'];
            $mean1 = getMean($testCase1);
            $this->assertEquals(3, $mean1['Score']);
            
            $testCase2 = $response[0]['name'];
            $mean2 = getMean($testCase2);
            $this->assertEquals(15, $mean2['Score']);
        }
        public function getMean($case){
            require_once __DIR__.'/../component/data-analyser/analyser.php';
            $analyser = new Profile();
            $profile = $analyser->calculateMean($case);
            return $profile;
        }
    }