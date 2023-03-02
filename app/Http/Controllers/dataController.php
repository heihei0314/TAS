<?php

namespace App\Http\Controllers;

use App\Http\Controllers\UserController;
use App\Models\dataCollection\dataCollection;
use App\Models\dataAnalyser\dataAnalyser;
use App\Models\dataAnalyser\winRateCalculator;
use Illuminate\Http\Request;
use Illuminate\Http\Client\Pool;
use Illuminate\Support\Facades\Http;

use DB;

class dataController extends Controller
{
    private $dataCollector;
    private $dataAnalyser;
    private $winRateCalculator;
    private $effectCalculator;
    public function __construct(dataCollection $dataCollection, dataAnalyser $dataAnalyser, winRateCalculator $winRateCalculator)
    {
        $this->dataCollector = $dataCollection;
        $this->dataAnalyser = $dataAnalyser;
        $this->winRateCalculator = $winRateCalculator;
    }
    
    public function index(Request $request)
    {
       $athletes = json_decode($this->getAthletes());
       $effect = $this->getEffect();
       $user = new UserController;
       $ip = $request->ip();
       $user->store($ip);
       return view('profile',['athletes' => $athletes,'effect' => $effect]);
    }
    
    public function getAthletes()
    {
        $API = $this->dataCollector->athletes();
        $athletes = array();
        foreach ($API as $value){
            array_push($athletes,$value['name']);
        }
        $athletes = array_unique($athletes);
        // convert to JSON
        $json = json_encode($athletes);
    
        // Set header to JSON format
        header('Content-Type: application/json; charset=utf-8');
  
        // return JSON
        //echo $json;
        return $json;
    }
    
    public function getGameData($athlete)
    {
        //call data collection
        $athletesAPI = $this->dataCollector->athletes();
        $gameAPI = $this->dataCollector->allGameData();
        //print_r($gameAPI);
        //print_r($athletesAPI);

        //proceed data transform
        $data=array();
        $testResult = array();
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
                        $data = array("name"=>$name,"court"=>$court,"color"=>$color,"winlose"=>$winlose,"WinningRound"=>$WinningRound,"Score"=>$Score,"Punch"=>$Punch,"Body"=>$Body,"SpinBody"=>$SpinBody,"SpinHead"=>$SpinHead,"Head"=>$Head,"Warning"=>$Warning);
                        array_push($testResult,$data);
                        
                        //Store in database
                        $this->putGameData($data);
                        //print_r($data);
                    }
                }               
            }
        }             
        return $testResult;
    }
    
    public function getProfile($athlete)
    {
        //grab data by calling function 
        //$profile = $this->dataAnalyser->mean($athlete);
        //change to event listener
        $this->putProfile($athlete);
        
        // grab data from db
        $sql = 'select * from profile where name like "'.$athlete.'"';
        $profile = DB::select($sql);
        if (count($profile)==0){
            array_push($profile,array("name"=>$athlete, "win"=>0, "lose"=>0, "WinningRound"=>0, "Score"=>0, "Punch"=>0, "Body"=>0, "SpinBody"=>0, "SpinHead"=>0, "Head"=>0, "Warning"=>0));
        }
        
        return $profile[0];
        //return $sql;
    }
    
    public function putProfile($athlete)
    {
        $profile = $this->dataAnalyser->mean($athlete);
        $sql = 'REPLACE INTO profile (name, win, lose, WinningRound, Score, Punch, Body, SpinBody, SpinHead, Head, Warning) VALUES ('.'"'.$athlete.'",'.$profile['win'].','.$profile['lose'].','.$profile['WinningRound'].','.$profile['Score'].','.$profile['Punch'].','.$profile['Body'].','.$profile['SpinBody'].','.$profile['SpinHead'].','.$profile['Head'].','.$profile['Warning'].')';
        DB::statement($sql);
        //return $sql;
    }
    
    public function putGameData($data)
    {
        $sql = 'REPLACE INTO gameData (name, court, color, winlose, WinningRound, Score, Punch, Body, SpinBody, SpinHead, Head, Warning) VALUES ('.'"'.$data['name'].'",'.'"'.$data['court'].'",'.'"'.$data['color'].'",'.'"'.$data['winlose'].'",'.$data['WinningRound'].','.$data['Score'].','.$data['Punch'].','.$data['Body'].','.$data['SpinBody'].','.$data['SpinHead'].','.$data['Head'].','.$data['Warning'].')';
        DB::statement($sql);
        //print_r($sql);
    }
    
    public function getWinRate($athlete1, $athlete2)
    {
        $winRate=$athlete1."/".$athlete2;
        $profile1 = $this->dataAnalyser->mean($athlete1);
        $profile2 = $this->dataAnalyser->mean($athlete2);
        $winRate = $this->winRateCalculator->winRate($profile1, $profile2);
        return $winRate;
    }
    public function getEffect()
    {
        $effect = $this->winRateCalculator->getEffect();
        return $effect;
    }
}
?>