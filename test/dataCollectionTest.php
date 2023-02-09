<?php
    use PHPUnit\Framework\TestCase;

    class dataCollectionTest extends \PHPUnit\Framework\TestCase{
        public function testAPIResponse(){
            require_once __DIR__.'/../component/data-collection/dataCollection.php';
            $connection = new dataCollection();
            $response = $connection->connectAPI('athletes');
            $response->assertStatus(200);

            $response = $connection->connectAPI('games');
            $response->assertStatus(200);
        }
    }
?>