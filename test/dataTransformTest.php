<?php
    use PHPUnit\Framework\TestCase;

    class dataTransformTest extends \PHPUnit\Framework\TestCase{
        public function testWinLoseRecord(){
            //stub athletes name for test (null, one entry data, three entries data)
            $athletesTest = Array("","Lam Ching Ho","Kong Hin Sing");
            $dataset = array();
            $testResult = array();
            
            //expected result
            $expectedDataCount = Array(0,1,3);

            //activate test   
            require_once __DIR__.'/../component/data-collection/dataTransform.php';
            $dataTransform = new dataTransform();
            foreach ($athletesTest as $athlete){
               $dataset = $dataTransform->transformData($athlete);   
            }   
            array_push($testResult,count($dataset));
            $this->assertEquals($expectedDataCount, $testResult);
        }
    }

?>
