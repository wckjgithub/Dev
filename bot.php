<?php
$access_token = 'W+DdxR3BykoBO/akLz+/c7xSd4omnqpXD3y89DLeQblSW/N3uVY87Ir/HKvXAPs10QQgkQJYEhEPeniV2R+Wq37u4IcBg8IduiW2XUDupwpJ4TifC6veeKIrvRXWM1EtQJkDVsYC/mep4b3OkwS1nQdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		//if ($event['type'] == 'user'){
			
		//}
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			
			// Get replyToken
			$replyToken = $event['replyToken'];

			// Build message to reply back
			switch ($text) {
			case "text" : 
				$messages = [
				'type' => 'text',
				'text' => $text
				];
				break;
			case "demo" : 
				$messages = [
				'type' => 'text',
				'text' => 'Remember...'.$text
				];
				break;
			default : 
				$messages = [
				'type' => 'text',
				//'text' => 'ฉันจะจดจำเรื่องที่คุณพูด...'.$text.''
				'text' => 'pop...'.$text.''
				];
				break;
			}

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}
	}
}
echo "OK";