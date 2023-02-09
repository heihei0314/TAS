<?php

class analyser {
    
    function calculateMean($athlete){
        //grab the game data from db
        require_once __DIR__.'/../../resource/controller.php';
        $controller = new Controller();
        $data = $controller->getGameData($athlete);

        //call the calculator
        $profile = array();
        $profile = $this->calculator($athlete, $data);

        //update the mean preformance to db
        $controller->putMean($profile);
        return $profile;
    }
    
    function calculator($athlete, $data){
        $n=0;
        $name = $athlete;
        $win=0;
        $lose=0;
        $m_WinningRound = 0;
        $m_Score = 0;
        $m_Punch = 0;
        $m_Body = 0;
        $m_SpinBody = 0;
        $m_SpinHead = 0;
        $m_Head = 0;
        $m_Warning = 0;
        foreach ($data as $value){
                $name=$value['name'];
                if($value['winlose']=='Win'){
                    $win++;
                }
                else {
                    $lose++;
                }
                
                $m_WinningRound += $value['WinningRound'];
                $m_Score += $value['Score'];
                $m_Punch += $value['Punch'];
                $m_Body += $value['Body'];
                $m_SpinBody += $value['SpinBody'];
                $m_SpinHead += $value['SpinHead'];
                $m_Head += $value['Head'];
                $m_Warning += $value['Warning'];
                $n++;
        }
            
        if($n!=0) {
                $m_WinningRound = $m_WinningRound/$n;
                $m_Score = $m_Score/$n;
                $m_Punch = $m_Punch/$n;
                $m_Body = $m_Body/$n;
                $m_SpinBody = $m_SpinBody/$n;
                $m_SpinHead = $m_SpinHead/$n;
                $m_Head = $m_Head/$n;
                $m_Warning = $m_Warning/$n;
        }
        $profile = array("name"=>$name,"win"=>$win,"lose"=>$lose,"WinningRound"=>$m_WinningRound,"Score"=>$m_Score,"Punch"=>$m_Punch,"Body"=>$m_Body,"SpinBody"=>$m_SpinBody,"SpinHead"=>$m_SpinHead,"Head"=>$m_Head,"Warning"=>$m_Warning);
        //print_r($profile);
                    
        return $profile;
    }
}

?>
