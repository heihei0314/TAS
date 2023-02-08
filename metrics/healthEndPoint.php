<?php
// check_and_notify.php 

function notifySlack(string $message): void
{
    $curl = curl_init();
    curl_setopt_array(
        $curl,
        [
        CURLOPT_URL => getSlackUrl(),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode([
            'text' => ":x: $message", // message content with emoji ❌
            'channel' => getSlackChannel() // channel where post the message
        ]),
        CURLOPT_HTTPHEADER => [
            sprintf('Authorization: Bearer %s', getSlackToken()), // access token given by slack
            "Content-type: application/json",
        ]
        ]
    );

    curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    if ($err) {
        logError($err);
    }
}

function isServerError($statusCode): bool
{
    return $statusCode >= 500 && $statusCode < 600;
}

function logError(string $content): void
{
    file_put_contents('log/log_'.date("j.n.Y").'.log', $content, FILE_APPEND);
}

// Health check on endpoint
foreach (getEndpointToCheck() as $endpoint) {
    $curlHandle = curl_init($endpoint);
    $response = curl_exec($curlHandle);
    curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);

    if (curl_errno($curlHandle) || !$response) {
        $message = sprintf("Unable to call %s, error: %s", $endpoint, curl_error($curlHandle));
        logError($message);
        notifySlack($message);
    } elseif (isServerError($statusCode = curl_getinfo($curlHandle, CURLINFO_HTTP_CODE))) {
        notifySlack(sprintf("%s seems down with status code %s", $endpoint, $statusCode));
    }
    curl_close($curlHandle);
}