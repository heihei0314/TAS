<?php
    namespace Tests\Unit;
    
    use PHPUnit\Framework\TestCase;
    use App\Http\Controllers;
    use App\Models\dataCollection\dataCollection;
    use App\Models\dataAnalyser\dataAnalyser;
    use App\Models\dataAnalyser\winRateCalculator;
    
    class dataTransformTest extends TestCase{
        public function testGameRecord(){
            //stub athletes name for test (null, one entry data, three entries data)
            $athletesTest = Array("","Lam Ching Ho","Kong Hin Sing");
            $dataset = array();
            $testResult = array();
            
            //expected result
            $expectedDataCount = Array(0,1,3);

            //activate test   
            
            $dataTransform = $this->dataController;
            foreach ($athletesTest as $athlete){
               $dataset = $dataTransform->getGameData($athlete);   
               array_push($testResult,count($dataset));
            }   
            
            $this->assertEquals($expectedDataCount, $testResult);
        }
    }

?>
