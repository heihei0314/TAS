<?php
    namespace Tests\Unit;
    
    use PHPUnit\Framework\TestCase;
    use App\Http\Controllers;
    use App\Models\dataCollection\dataCollection;
    use App\Models\dataAnalyser\dataAnalyser;
    use App\Models\dataAnalyser\winRateCalculator;
    
    class dataCollectionTest extends TestCase{
    private $dataCollector;
    private $dataAnalyser;
    private $winRateCalculator;
    public function __construct(dataCollection $dataCollection, dataAnalyser $dataAnalyser, winRateCalculator $winRateCalculator)
    {
        $this->dataCollector = $dataCollection;
        $this->dataAnalyser = $dataAnalyser;
        $this->winRateCalculator = $winRateCalculator;
    }
    public function testAPIResponse(){
            $athletesAPI = $this->dataCollector->athletes();
            $this->assertGreaterThan(0,count($athletesAPI));

            $gameAPI = $this->dataCollector->allGameData();
            $this->assertGreaterThan(0,count($gameAPI));
        }
    }
?>