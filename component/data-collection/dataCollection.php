<?php
    
    Class dataCollection{
        //get data from public API
        function connectAPI($data_key){
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
            $response = $api[$data_key];
            
            return $response;
        }
    }
?>