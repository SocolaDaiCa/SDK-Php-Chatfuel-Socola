<?php
	// require_once __DIR__ . '/' . '../src/socola/Chatfuel.php';
	// // Chatfuel::sendText("ádas");
	// $bot = new Chatfuel();


	// print_r($_SERVER);
	require_once __DIR__ . '/' . 'vendor/autoload.php';
	use Socola\Chatfuel;
	## Create bot
	$bot = new Chatfuel();

	## Send text
	$text = 'Socola';
	$texts = [$text, $text, $text, $text];
	$bot->sendText($text);
	$bot->sendText($texts);

	## Send image
	$image = 'http://i.imgur.com/luWlRwV.jpg';
	$images = [
		'http://i.imgur.com/luWlRwV.jpg',
		'http://i.imgur.com/luWlRwV.jpg'
	];
	$bot->sendImage($image);
	$bot->sendImage($images);

	## Send file
	$file = 'https://01b02091.ngrok.io/test.pdf';
	$files = array(
		'https://01b02091.ngrok.io/test.pdf',
		'https://01b02091.ngrok.io/test.pdf'
	);
	$bot->sendFile($file);
	$bot->sendFile($files);

	## Send audio
	$audio = 'https://01b02091.ngrok.io/test.mp3';
	$audios = [
		'https://01b02091.ngrok.io/test.mp3',
		'https://01b02091.ngrok.io/test.mp3'
	];
	$bot->sendAudio($audio);
	$bot->sendAudio($audios);

	## Create a button
	### Create Button To URL
	$title = "button to url";
	$url = "http://www.facebook.com";
	$buttonToURL = $bot->createButtonToURL($title, $url, Null);

	### Create Button To Block
	$title = "button to block";
	$block = "re-start";
	$buttonToBlock = $bot->createButtonToBlock($title, $block, Null);

	### Create Button Share
	$buttonShare = $bot->createButtonShare();

	### Create Button Call
	$phoneNumber = '096******5';
	$buttonCall  = $bot->createButtonCall($phoneNumber, 'Call');

	### Create Button Quick Reply
	$block = 're-start';
	$blocks = [
		'play',
		'pause'
	];
	$bot->createButtonQuickReply($title, $block);
	$bot->createButtonQuickReply($title, $blocks);


	### Send a text card with one or more button (max 3 buttons)
	$text = 'this is text card';
	$buttons = [
		$buttonToURL,
		$buttonToBlock,
		$buttonShare
	];
	$bot->sendTextCard($text, $buttonToURL);
	$bot->sendTextCard($text, $buttons);


	### Create element
	$title    = 'this is element';
	$image    = 'http://i.imgur.com/luWlRwV.jpg';
	$subTitle = 'this is sub title';
	$element  = $bot->createElement($title, $image, $subTitle, $buttonToURL);
	$elements = [$element, $element];
	$bot->sendGallery($element);
	### Send a list template min 2 element
	$topElementStyle = 'large';
	$bot->sendList($elements, $topElementStyle);
?>
