<?php
require_once 'vendor/autoload.php';

$client = new GuzzleHttp\Client([
   'base_uri' => 'https://api.us-south.speech-to-text.watson.cloud.ibm.com/instances/e167c678-2188-4665-b306-96637b8cd51c/'
]);

$audio = fopen('../audio/1.mp3', 'r');
$resp = $client->request('POST', 'v1/recognize', [
   'api' => ['username', 'z7YeOpDC16-zY09vrNgk49DhADD-YZpuLQrqtf8mVA6l'],
   'headers' => [
      'Content-Type' => 'audio/mpeg',
   ],
   'body' => $audio
]);

echo $resp->getBody();
