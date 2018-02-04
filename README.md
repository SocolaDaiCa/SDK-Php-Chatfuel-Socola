# SDK-Php-Chatfuel-Socola
SDK Php Chatfue Socola <br>
Using php to generate JSON for Chatfuel bot
## Create bot
```php
use Socola\Chatfuel;
$bot = new Chatfuel();
```
## Send text
```php
$text = 'Socola';
$texts = [$text, $text, $text, $text];
$bot->sendText($text);
$bot->sendText($texts);
```
## Send image
```php
$image = 'http://i.imgur.com/luWlRwV.jpg';
$images = [
	'http://i.imgur.com/luWlRwV.jpg',
	'http://i.imgur.com/luWlRwV.jpg'
];
$bot->sendImage($image);
$bot->sendImage(images);
```
## Send file
```javascript
$file = 'https://01b02091.ngrok.io/test.pdf';
$files = array(
	'https://01b02091.ngrok.io/test.pdf',
	'https://01b02091.ngrok.io/test.pdf'
);
$bot->sendFile($file);
$bot->sendFile($files);
```
## Send audio
```javascript
$audio = 'https://01b02091.ngrok.io/test.mp3';
$audios = [
	'https://01b02091.ngrok.io/test.mp3',
	'https://01b02091.ngrok.io/test.mp3'
];
$bot->sendAudio($audio);
$bot->sendAudio($audios);
```
## Create a button
### Create Button To URL
```javascript
$title = "button to url";
$url = "http://www.facebook.com";
$buttonToURL = $bot->createButtonToURL($title, $url, $setAttributes = Null);
```
### Create Button To Block
```javascript
$title = "button to block";
$block = "re-start";
$buttonToBlock = $bot->createButtonToBlock($title, $block, $setAttributes = Null);
```
### Create Button Share
```javascript
$buttonShare = $bot->createButtonShare();
```
### Create Button Call
```javascript
$phoneNumber = '096******5';
$buttonCall  = $bot->createButtonCall($phoneNumber, $title = 'Call');
```
### Create Button Quick Reply
```javascript
$block = 're-start';
$blocks = [
	'play',
	'pause'
];
$bot->createButtonQuickReply($title, $block);
$bot->createButtonQuickReply($title, $blocks);
```

### Send a text card with one or more button (max 3 buttons)
```javascript
$text = 'this is text card';
$uttons = [
	$buttonToURL,
	$buttonToBlock,
	$buttonShare
];
$bot->sendTextCard($text, $button);
$bot->sendTextCard($text, $buttons);
```

### Create element
```javascript
$title    = 'this is element';
$image    = 'http://i.imgur.com/luWlRwV.jpg';
$subTitle = 'this is sub title';
$element  = $bot->createElement($title, $image, $subTitle, $button_or_arrayButtons);
$arrayElements = array(
	$element1,
	$element2
);
```

### Send a gallery
```javascript
$bot->sendGallery($element_or_arrayElements);
```

### Send a list template min 2 element
You can switch type “top_element_style” between “large” and “compact”.
```javascript
$topElementStyle = 'large';
$bot->sendList($arrayElements, $topElementStyle);
```
