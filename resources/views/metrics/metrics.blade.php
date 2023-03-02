<?php

#//metrics endpoint that uses a metrics library (# request per second) json data and 200 ok
//echo 'metrics check endpoint: <br>';
use Illuminate\Http\Client\Pool;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\UserController;

$response = Http::get('https://waitsuentkd.com/tas2/public');
$header = json_encode($response->headers());
//print_r($header);
//echo "<br>";

//print_r($response->status());
if ($response->ok()){
    $responseCode =  $response->status().' ok';
}
else{
    $responseCode = $response->status().' error';
}
$metrics = 1;
$user = new UserController;
$metrics = $user->counter();
$json = array("response"=>$responseCode, "request_per_second"=>$metrics);

echo json_encode($json);


?>