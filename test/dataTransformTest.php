<?php
    use PHPUnit\Framework\TestCase;

    class dataTransformTest extends \PHPUnit\Framework\TestCase{
        public function testWinLoseRecord(){
            //stub athletes name for test (null, one entry data, three entries data)
            $athletesTest = Array("","Lam Ching Ho","Kong Hin Sing");
            $testWinlose = array();
            $winLose = array();
            
            //expected result
            $expectedWinLose = Array(Array(),Array("Win"),Array("Lose","Lose","Win"));

            //activate test   
            require_once __DIR__.'/../component/data-collection/dataTransform.php';
            $dataTransform = new dataTransform();
            foreach ($athletesTest as $athlete){
               $winLose = $dataTransform->transformData($athlete);   
            }   
            array_push($testWinlose,$winLose);
            $this->assertEquals($expectedScore, $testScore);
        }
    }

?>
