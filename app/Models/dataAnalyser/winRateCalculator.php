<?php

namespace App\Models\dataAnalyser;

use App\Models\dataAnalyser\effectCalculator;
class winRateCalculator {
    
    function getEffect(){
        $effect = new effectCalculator();
        $result = $effect->effect();
        return $result;
    }
    
    function winRate($mean1, $mean2){
        $effectContainer = new effectCalculator();
        $effect = $effectContainer->effect();
        $punch = $effect['punch'];
        $Body = $effect['body'];
        $Head = $effect['head'];
        $SpinBody = $effect['spinBody'];
        $SpinHead = $effect['spinHead'];
        $Warning = $effect['warning'];
        if(is_null($mean1)||is_null($mean2)){
            $winRate1=0;
            $winRate2=0;
        }
        else{
            $weight1 = $punch * $mean1['Punch'] + $Body * $mean1['Body'] + $Head * $mean1['Head'] + $SpinBody * $mean1['SpinBody'] + $SpinHead * $mean1['SpinHead'] + $Warning * $mean1['Warning'];
            $weight2 = $punch * $mean2['Punch'] + $Body * $mean2['Body'] + $Head * $mean2['Head'] + $SpinBody * $mean2['SpinBody'] + $SpinHead * $mean2['SpinHead'] + $Warning * $mean2['Warning'];
        }
        
        if($weight1==0&&$weight2==0){
            $winRate1 = 0.5;
            $winRate2 = 0.5;
        }
        elseif($weight1<0){
            $weight2 = $weight2-$weight1;
            $weight1 = 0;
        }
        elseif($weight2<0){
            $weight1 = $weight1-$weight2;
            $weight2 = 0;
        }
        else{
            $winRate1 = $weight1/($weight1+$weight2);
            $winRate2 = 1-$winRate1;
        }
        $winRate1 = round($winRate1*100, 2)."%";
        $winRate2 = round($winRate2*100, 2)."%";
        $winRate=array();
        array_push($winRate,$winRate1);
        array_push($winRate,$winRate2);
        return $winRate;
    }
    
}