<?php
    
    Class eventCollaboration{
        //call data-analyser get mean (event message collaboration) 
        function messageQueue(){

        }
        function eventListener(){
            //listen message Queue;
        }
        function getDBMean(){
            //get mean from db
            include 'controller.php';
            controller = new Controller();
            $meanData = array();
            $meanData = controller->getMean($athlete);
            //get mean from db
        }
    }

?>
