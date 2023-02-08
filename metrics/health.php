<?php
// config.php
// config can be done with constant
const ENDPOINT_TO_CHECK = ['tas.waitsuen.com', 'http://127.0.0.1:8000']; 
const SLACK_CHANNEL = 'monitoring-web-app'; // channel where post the message
const SLACK_URL = 'https://slack.com/api/chat.postMessage';
const SLACK_TOKEN= 'token given by slack';

// config with function to fetch env var...
function getSlackUrl(): string
{
    return SLACK_URL;
}

function getEndPointToCheck(): array
{
    return ENDPOINT_TO_CHECK;
}

function getSlackToken(): string
{
    return SLACK_TOKEN;
}

function getSlackChannel(): string
{
    return SLACK_CHANNEL;
}