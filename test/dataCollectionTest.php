<?php
    use PHPUnit\Framework\TestCase;

    class dataCollectionTest extends \PHPUnit\Framework\TestCase{
        public function testAPIResponse(){
            require_once __DIR__.'/../component/data-collection/dataCollection.php';
            $connection = new dataCollection();
            $response = $connection->connectAPI('athletes');
            $this->assertGreaterThan(0,count($response));

            $response = $connection->connectAPI('games');
            $this->assertGreaterThan(0,count($response));
        }
    }
?>