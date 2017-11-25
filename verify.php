<?php
$access_token = 'W+DdxR3BykoBO/akLz+/c7xSd4omnqpXD3y89DLeQblSW/N3uVY87Ir/HKvXAPs10QQgkQJYEhEPeniV2R+Wq37u4IcBg8IduiW2XUDupwpJ4TifC6veeKIrvRXWM1EtQJkDVsYC/mep4b3OkwS1nQdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;