<?php

namespace App\Models\dataAnalyser;
use App\Models\dataCollection\dataCollection;
class effectCalculator {
    
    function effect(){
        $gameData = $this->getGameData();
        //$win=$gameData[0];
        //$lose=$gameData[1];
        $g=0;
        $w=0;
        $l=0;
        $punch = array('g'=>0,'w'=>0,'l'=>0,'e'=>0);
        $Body = array('g'=>0,'w'=>0,'l'=>0,'e'=>0);
        $Head = array('g'=>0,'w'=>0,'l'=>0,'e'=>0);
        $SpinBody = array('g'=>0,'w'=>0,'l'=>0,'e'=>0);
        $SpinHead = array('g'=>0,'w'=>0,'l'=>0,'e'=>0);
        $Warning = array('g'=>0,'w'=>0,'l'=>0,'e'=>0);
        foreach ($gameData as $data){
            $punch['g'] += $data['Punch'];
            $Body['g'] += $data['Body'];
            $Head['g'] += $data['Head'];
            $SpinBody['g'] += $data['SpinBody'];
            $SpinHead['g'] += $data['SpinHead'];
            $Warning['g'] += $data['Warning'];
            $g++;
            if ($data['winlose'] == "Win"){
                $punch['w'] += $data['Punch'];
                $Body['w'] += $data['Body'];
                $Head['w'] += $data['Head'];
                $SpinBody['w'] += $data['SpinBody'];
                $SpinHead['w'] += $data['SpinHead'];
                $Warning['w'] += $data['Warning'];
                $w++;
            }
            else if ($data['winlose'] == "Lose"){
                $punch['l'] += $data['Punch'];
                $Body['l'] += $data['Body'];
                $Head['l'] += $data['Head'];
                $SpinBody['l'] += $data['SpinBody'];
                $SpinHead['l'] += $data['SpinHead'];
                $Warning['l'] += $data['Warning'];
                $l++;
            }
        }
        if(($punch['w']/$w)==0&&($punch['l']/$l)==0){
            $punch['e'] = 0;
        }else{
            $punch['e'] = ($punch['w']/$w)/(($punch['w']/$w)+($punch['l']/$l));
        }
        if(($Body['w']/$w)==0&&($Body['l']/$l)==0){
            $Body['e'] = 0;
        }else{
            $Body['e'] = ($Body['w']/$w)/(($Body['w']/$w)+($Body['l']/$l));
        }
        if(($Head['w']/$w)==0&&($Head['l']/$l)==0){
            $Head['e'] = 0;
        }else{
            $Head['e'] = ($Head['w']/$w)/(($Head['w']/$w)+($Head['l']/$l));
        }
        if(($SpinBody['w']/$w)==0&&($SpinBody['l']/$l)==0){
            $SpinBody['e'] = 0;
        }else{
            $SpinBody['e'] = ($SpinBody['w']/$w)/(($SpinBody['w']/$w)+($SpinBody['l']/$l));
        }
        if(($SpinHead['w']/$w)==0&&($SpinHead['l']/$l)==0){
            $SpinHead['e'] = 0;
        }else{
            $SpinHead['e'] = ($SpinHead['w']/$w)/(($SpinHead['w']/$w)+($SpinHead['l']/$l));
        }
        if(($Warning['w']/$w)==0&&($Warning['l']/$l)==0){
            $Warning['e'] = 0;
        }else{
            $Warning['e'] = -($Warning['w']/$w)/(($Warning['w']/$w)+($Warning['l']/$l));
        }
        
        $effect = array(
            'punch'=>$punch['e'],
            'body'=>$Body['e'],
            'head'=>$Head['e'],
            'spinBody'=>$SpinBody['e'],
            'spinHead'=>$SpinHead['e'],
            'warning'=>$Warning['e']
            );
        
        return $effect;
    }
    function getGameData()
    {
       //call data collection
        $athletesAPI = $this->api('athletes');
        $gameAPI = $this->api('games');
        //print_r($gameAPI);
        //print_r($athletesAPI);

        //proceed data transform
        $data=array();
        $winData=array();
        $loseData=array();
        $result = array();
        foreach ($athletesAPI as $a){
                $name = $a['name'];
                $court = $a['court'];
                $color = $a['Color'];
                foreach ($gameAPI as $g){
                    if ($court==$g['court']){
                        //get winlose
                        if (is_null($color)){
                            $winlose = '';
                        }
                        else if($color==$g['gameWinner']){
                            $winlose = 'Win';
                        }
                        else {
                            $winlose = 'Lose';
                        }
        
                        //mapping data
                        switch ($color){
                            case 'R':
                                $WinningRound = $g['rWinningRound'];
                                $Score = $g['RScore'];
                                $Punch = $g['RPunch'];
                                $Body = $g['RBody'];
                                $SpinBody = $g['RSpinBody'];
                                $SpinHead = $g['RSpinHead'];
                                $Head = $g['RHead'];
                                $Warning = $g['RWarning'];
                                break;
                            case 'B':
                                $WinningRound = $g['bWinningRound'];
                                $Score = $g['blueScore'];
                                $Punch = $g['BPunch'];
                                $Body = $g['BBody'];
                                $SpinBody = $g['BSpinBody'];
                                $SpinHead = $g['BSpinHead'];
                                $Head = $g['BHead'];
                                $Warning = $g['BWarning'];
                                break;
                        }
                        
                        $data = array("name"=>$name,"court"=>$court,"color"=>$color,"winlose"=>$winlose,"WinningRound"=>$WinningRound,"Score"=>$Score,"Punch"=>$Punch,"Body"=>$Body,"SpinBody"=>$SpinBody,"SpinHead"=>$SpinHead,"Head"=>$Head,"Warning"=>$Warning);
                        array_push($result,$data);
                        /*switch ($winlose){
                            case "Win":
                                array_push($winData,$data);
                                break;
                            case "Lose":
                                array_push($loseData,$data);
                                break;
                        }*/
                    }
                }               
        }        
        //array_push($result,$winData);
       // array_push($result,$loseData);
        return $result;
    }
    
    function api($datakey){
            //connect to resource
            $url = "http://www.waitsuentkd.com/sparring/API/resource.php";
    
            //connect to resource
            $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded"
                )
            );
        
            $context  = stream_context_create($options);
            $result = file_get_contents($url, false, $context);
            
        
            // convert to array
            $api = json_decode($result, true);
            $response = $api[$datakey];
            
            return $response;
    }
}