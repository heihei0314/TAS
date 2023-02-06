<?php
    $test = "Lam Ching Ho";
    if(isset($_GET['test'])){
        $test = $_GET['test'];
    }
echo $test;
    $dataTransform = new dataTransform();
    $dataTransform->transformData($test);
    Class dataTransform{
        //transform data
        function transformData($athlete){
            //call data collection
            require_once __DIR__.'/dataCollection.php';
            $dataCollection = new dataCollection();
            $gameAPI = $dataCollection->connectAPI('games');
            $athletesAPI = $dataCollection->connectAPI('athletes');
            //print_r($gameAPI);
            //print_r($athletesAPI);

            //proceed data transform
            $data=array();
            foreach ($athletesAPI as $a){
                if($a['name']==$athlete){
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
                        
                    }
                    }
                    $data = array("name"=>$name,"court"=>$court,"color"=>$color,"winlose"=>$winlose,"WinningRound"=>$WinningRound,"Score"=>$Score,"Punch"=>$Punch,"Body"=>$Body,"SpinBody"=>$SpinBody,"SpinHead"=>$SpinHead,"Head"=>$Head,"Warning"=>$Warning);
                    
                    //Store in database
                    require_once __DIR__.'/../../resource/controller.php';
                    $controller = new Controller();
                    $controller->putGameData($data);
                    array_push($data,$temp);
                    //print_r($data);
                }
            }             
        }
    }
?>
