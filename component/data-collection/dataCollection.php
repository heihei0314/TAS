<?php
    
    Class dataCollection{
        //get data from public API
        function connectAPI($data_key){
            //connect to resource
            $url = "https://www.waitsuentkd.com/sparring/API/resource.php";
    
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_key);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
              'Content-Type: application/json')
            );
            
            // get json
            $result = curl_exec($ch);
            // echo $result;
            curl_close($ch);    
            //connect to resource
            
            //convert to array
            $api = json_decode($result, true);
            $response = $api[$data_key];
            //echo count($api);
        
            return $response;
        }
        //call data-analyser get mean (event message collaboration) 
        function postMean(){
        
        }
    
        function postData(){
        
        }
    }
?>