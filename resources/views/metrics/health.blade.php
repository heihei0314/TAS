<?php
echo 'health check endpoint: <br>';
use Illuminate\Http\Client\Pool;
use Illuminate\Support\Facades\Http;
 
$response = Http::get('https://waitsuentkd.com/tas2/public');
$header = $response->headers();
print_r($header['Date'][0]);
echo "<br>";

print_r($response->status());
if ($response->ok()){
    echo ' ok';
}
else{
    echo ' error';
}

?>