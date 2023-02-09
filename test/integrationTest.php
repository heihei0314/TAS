<?php
    use PHPUnit\Framework\TestCase;

    class integrationTest extends \PHPUnit\Framework\TestCase{
        public function getAthletes(){
            require_once __DIR__.'/../resource/controller.php';
            $controller = new Controller();
            $allAthletes = $controller->getAthletes();
            $this->assertGreaterThan(0,count($response));
            $this->assertEquals("Lam Ching Ho",$response[0]['name']);
        }
    }