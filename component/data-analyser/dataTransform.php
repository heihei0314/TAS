<?php
    
    Class dataTransform{
        //transform data
        function transformData($game, $allAthletes,$athlete){
            //call data collection
            require_once __DIR__.'/../data-collection/dataCollection,php';
            $dataCollection = new dataCollection();
            $gameAPI = $dataCollection->connectAPI('games');
            $athletesAPI = $dataCollection->connectAPI('athletes');
            
            //proceed data transform
            $data=array();
            foreach ($athletesAPI as $a){
                if(is_null($a)){ $temp = array();}
                else if($a['name']==$athlete){
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
                        //get winlose
        
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
                        
                    }
                    }
                    $temp = array("name"=>$name,"court"=>$court,"color"=>$color,"winlose"=>$winlose,"WinningRound"=>$WinningRound,"Score"=>$Score,"Punch"=>$Punch,"Body"=>$Body,"SpinBody"=>$SpinBody,"SpinHead"=>$SpinHead,"Head"=>$Head,"Warning"=>$Warning);
                    array_push($data,$temp);
                    //print_r($temp);
                }
            }
            
            //putMean();
            
            return $data;
        }
    }
?>
