<?php
        
class winRateCalculator {
    
    function getWinRate($athlete1, $athlete2){
        $punch = 1;
        $Body = 4;
        $Head = 5;
        $SpinBody = 3;
        $SpinHead = 2;
        $Warning = -1;
        
        
        include '../resource/controller.php';
        $controller = new Controller();
        $mean1 = $controller->getMean($athlete1);
        $mean2 = $controller->getMean($athlete2);
        if(isnull($mean1)||isnull($mean2)){
            $winRate1=0;
            $winRate2=0;
        }
        else{
            $weight1 = $punch * $mean1['Punch'] + $Body * $mean1['Body'] + $Head * $mean1['Head'] + $SpinBody * $mean1['SpinBody'] + $SpinHead * $mean1['SpinHead'] + $Warning * $mean1['Warning'];
            $weight2 = $punch * $mean2['Punch'] + $Body * $mean2['Body'] + $Head * $mean2['Head'] + $SpinBody * $mean2['SpinBody'] + $SpinHead * $mean2['SpinHead'] + $Warning * $mean2['Warning'];
        
            $winRate1 = $weight1/($weight1+$weight2);
            $winRate2 = 1-$winRate1;
        }
        $winRate1 = round($winRate1, 2)."%";
        $winRate2 = round($winRate2, 2)."%";
        $winRate=array();
        array_push($winRate,$winRate1);
        array_push($winRate,$winRate2);
        return $winRate;
        //print_r($mean1);
    }
}

?>