<?php
        
class Profile {
    
    function calculateMean($athlete){
        include "../../resource/controller.php";
        $controller = new Controller();
        $data = $controller->getGameData($athlete);
        return calculater($athlete, $data);
    }

    function calculater($data){
        $n=0;
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
        if(is_null($data)){
            $n=1;
        }
        else {
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
        }
        $m_WinningRound = $m_WinningRound/$n;
        $m_Score = $m_Score/$n;
        $m_Punch = $m_Punch/$n;
        $m_Body = $m_Body/$n;
        $m_SpinBody = $m_SpinBody/$n;
        $m_SpinHead = $m_SpinHead/$n;
        $m_Head = $m_Head/$n;
        $m_Warning = $m_Warning/$n;
        $profile = array("name"=>$name,"win"=>$win,"lose"=>$lose,"WinningRound"=>$m_WinningRound,"Score"=>$m_Score,"Punch"=>$m_Punch,"Body"=>$m_Body,"SpinBody"=>$m_SpinBody,"SpinHead"=>$m_SpinHead,"Head"=>$m_Head,"Warning"=>$m_Warning);
        //print_r($profile);
        return $profile;
    }
    function updateMean(){
        //putMean();
    }
}

?>