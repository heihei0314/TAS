<?php
    
    Class dataCollection{
        //get data from public API
        function connectAPI($data_key){
            //connect to resource
            $url = "https://www.waitsuentkd.com/sparring/API/resource.php";
    
            //connect to resource
            $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded"
                )
            );
        
            $context  = stream_context_create($options);
            $result = file_get_contents($url, false, $context);
            //connect to resource
        
            $response = json_decode($result, true);
            //echo count($data);
            // get json and convert to array
            return $response;
        }
    }
?>