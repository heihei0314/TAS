<?php

namespace App\Models\dataCollection;

class dataCollection
{
    /**
     * @return json string
     */
    public function athletes()
    {
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
            $response = $api['athletes'];
            
            return $response;
    }
        /**
     * @return json string
     */
    public function allGameData()
    {
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
            $response = $api['games'];
            
            return $response;
    }
}