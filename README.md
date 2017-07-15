# SDK-Php-Chatfuel-Socola
SDK Php Chatfue Socola <br>
Using php to generate JSON for Chatfuel bot

## all doc
[eate bot](#create-bot)<br>
[Send text messages](#Send-text-messages)<br>
[Send an image](#Send-an-image)<br>
[Send a file](#Send-a-file)<br>
[Send an audio](#Send-an-audio)<br>
[Create a button](#Create-a-button)<br>
[Create Button To URL](#Create-Button-To-URL)<br>
[Create Button To Block](#Create-Button-To-Block)<br>
[Create Button Share](#Create-Button-Share)<br>
[Create Button Call](#Create-Button-Call)<br>
[Create Button Quick Reply](#Create-Button-Quick-Reply)<br>
[Send a text card with one or more button (max 3 buttons)](#Send-a-text-card-with-one-or-more-button-(max-3-buttons))<br>
[# Create element](#Create-element)<br>
[Send a gallery](#Send-a-gallery)<br>
[Send a list template min 2 element](#Send-a-list-template-min-2-element)<br>

## Create bot
```javascript
require_once 'SDK-Php-Chatfuel-Socola.javascript';
$bot = new Chatfuel(TRUE);
```

## Send text messages
```javascript
$text = 'Socola';
$arrayTexts = array(
	'Socola',
	'Đại',
	'Ca'
);
$bot->sendText($text_or_arrayTexts);
```

## Send an image
```javascript
$image = 'http://i.imgur.com/luWlRwV.jpg';
$arrayImages = array(
	'http://i.imgur.com/luWlRwV.jpg',
	'http://i.imgur.com/luWlRwV.jpg'
);
$bot->sendImage($image_or_arrayImages);
```

## Send a file
```javascript
$file = 'https://01b02091.ngrok.io/test.pdf';
$arrayFiles = array(
	'https://01b02091.ngrok.io/test.pdf',
	'https://01b02091.ngrok.io/test.pdf'
);
$bot->sendFile($file_or_arrayFiles);
```

## Send an audio
```javascript
$audio = 'https://01b02091.ngrok.io/test.mp3';
$arrayAudios = array(
	'https://01b02091.ngrok.io/test.mp3',
	'https://01b02091.ngrok.io/test.mp3'
);
$bot->sendAudio($audio_or_arrayAudios);
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
$buttonCall    = $bot->createButtonCall($phoneNumber, $title = 'Call');
```

### Create Button Quick Reply
```javascript
$block = "re-start";
$arrayBlocks = array(
	'play',
	'pause'
);
$bot->createButtonQuickReply($title, $block_or_arrayBlocks);
```

### Send a text card with one or more button (max 3 buttons)
```javascript
$text = 'this is text card';
$arrayButtons = array(
	$buttonToURL,
	$buttonToBlock,
	$buttonShare
);
$bot->sendTextCard($text, $button_or_arrayButtons);
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


```javascript

```
