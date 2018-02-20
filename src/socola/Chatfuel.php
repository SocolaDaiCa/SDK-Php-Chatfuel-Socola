<?php

/**
 * @Author: Socola
 * @Email: TokenTien@gmail.com
 * @Date:   2018-02-16 07:34:15
 * @Last Modified by:   Socola
 * @Last Modified time: 2018-02-20 07:44:15
 */
/**
 * http://docs.chatfuel.com/plugins/plugin-documentation/json-api
 */
	namespace Socola;
	interface ChatfuelInterface{
		public function sendText($text_or_arrayTexts);
		public function sendImage($image_or_arrayImages);
		public function sendFile($file_or_arrayFiles);
		public function sendVideo($url_or_arrayUrls);
		public function sendAudio($audio_or_arrayAudios);

		public function createButtonToURL($title, $url, $setAttributes = NULL);
		public function createButtonToBlock($title, $block_or_arrayBlocks, $setAttributes = NULL);
		public function createButtonShare();
		public function createButtonCall($phoneNumber, $title = 'Call');
		public function createButtonQuickReply($title, $block_or_arrayBlocks);

		public function sendTextCard($text, $buttons_or_arrayButtons);
		public function createElement($title, $image, $subTitle, $buttons);
		public function sendGallery($element_or_arrayElement);
		public function sendList($arrayElements, $topElementStyle = 'large');
		public function isURL($url);
	}
	class Chatfuel implements ChatfuelInterface
	{
		protected $debug;
		protected $messages;
		function __construct($debug = false)
		{
			$this->debug = $debug;
		}

		public function sendText($messages = null){
			$type = gettype($messages);

			if(is_null($messages)){
				return $this->messages[] = ['text' => 'Eror: messages null'];
			}

			if($type === 'array' || is_array($messages)){
				foreach ($messages as $message) {
					$this->messages[] = ['text' => $message];
				}
				return;
			}
			$this->messages[] = ['text' => $messages];
		}

		public function sendImage($url)
		{
			self::sendMedia('image', $url);
		}

		public function sendFile($url)
		{
			self::sendMedia('file', $url);
		}

		public function sendVideo($url)
		{
			self::sendMedia('video', $url);
		}

		public function sendAudio($url)
		{
			self::sendMedia('audio', $url);
		}

		public function createButtonToURL($title, $url, $setAttributes = NULL)
		{
			if (self::isURL($url)) {
				return null;
			}

			$button = [
				'type'  => 'web_url',
				'url'   => $url,
				'title' => $title,
			];

			if (!is_null($setAttributes) && is_array($setAttributes)) {
				$button['set_attributes'] = $setAttributes;
			}

			return $button;
		}

		public function createButtonToBlock($title, $block, $setAttributes = NULL)
		{
			$button = [
				'type' => 'show_block',
				'title' => $title
			];

			if (is_array($block)) {
				$button['block_names'] = $block;
			} else {
				$button['block_name'] = $block;
			}

			if (!is_null($setAttributes) && is_array($setAttributes)) {
				$button['set_attributes'] = $setAttributes;
			}

			return $button;
		}

		public function createButtonCall($phoneNumber, $title = 'Call')
		{
			return [
				'type' => 'phone_number',
				'phone_number' => $phoneNumber,
				'title' => $title
			];
		}

		public function createButtonQuickReply($title, $block)
		{
			$button = array(
				'title' => $title
			);

			if (is_array($block)) {
				$button['block_names'] = $block;
			} else {
				$button['block_name'] = $block;
			}

			return $button;
		}


		/* đang test*/
		public function createButtonShare()
		{
			return [
				'type' => 'element_share'
			];
		}
		/* test*/

		public function sendTextCard($text, $buttons)
		{
			if(empty($buttons[0]['title']))
				$buttons = [$buttons];

			self::sendAttachment('template', [
				'template_type' => 'button',
				'text' => $text,
				'buttons' => $buttons
			]);
		}

		public function createElement($title, $image, $subTitle, $buttons)
		{
			if(empty($buttons[0]['type']))
				$buttons = [$buttons];

			if (self::isURL($image) && is_array($buttons)) {
				return array(
					'title' => $title,
					'image_url' => $image,
					'subtitle' => $subTitle,
					'buttons' => $buttons
				);
			}

			return FALSE;
		}

		public function sendGallery($elements)
		{
			if(empty($elements[0]['title']))
				return FALSE;

			self::sendAttachment('template', [
				'template_type' => 'generic',
				'elements'      => $elements
			]);
		}

		public function sendList($elements, $topElementStyle = 'large')
		{
			if(empty($elements[0]['title']))
				$elements = array($elements);

			self::sendAttachment('template', [
				'template_type'     => 'list',
				'top_element_style' => $topElementStyle,
				'elements'          => $elements
			]);
		}

		function __destruct()
		{
			self::sentMessages();
		}

		public function isURL($url){
			return filter_var($url, FILTER_VALIDATE_URL);
		}

		public function sendMedia($type, $url)
		{
			if(!is_array($url)){
				$url = array($url);
			}

			foreach ($url as $value) {
				if (self::isURL($value)) {
					self::sendAttachment($type, ['url' => $value]);
				} else {
					self::sendText("Error: Invalid {$type} URL!");
				}
			}
		}

		private function sendAttachment($type, $payload){
			$type       = strtolower($type);
			$validTypes = array(
				'image',
				'file',
				'video',
				'audio',
				'template'
			);

			if (in_array($type, $validTypes)) {
				$this->messages[] = array(
					'attachment' => array(
						'type' => $type,
						'payload' => $payload
					)
				);
			} else {
				self::sendText('Error: Invalid type!');
			}
		}

		public function sentMessages()
		{
			if(is_null($this->messages))
				self::sendText(NULL);
			header('Content-Type: application/json; charset=UTF-8');
			if($this->debug){
				echo json_encode(['messages' => $this->messages], JSON_PRETTY_PRINT);
			}else{
				echo json_encode(['messages' => $this->messages]);
			}
		}

	}
