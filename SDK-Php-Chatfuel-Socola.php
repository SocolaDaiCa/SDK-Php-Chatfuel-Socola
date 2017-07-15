<?php 
	/**
	* 
	*/
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
		private $debug;
		public $messages;
		public function __construct($debug = flase)
		{
			// header('Content-Type: application/json; charset=UTF-8');
			$this->debug = $debug;
		}

		public function sendText($messages = null){
			$type = gettype($messages);

			if(is_null($messages)){
				$this->messages[] = array(
					'text' => 'Eror: messages null.'
				);
			}elseif($type === 'string'){
				$this->messages[] = array(
					'text' => $messages
				);
			}elseif($type === 'array' || is_array($messages)){
				foreach ($messages as $message) {
					$this->messages[] = array(
						'text' => $message 
					);
				}
			}
		}

	    public function sendImage($url)
	    {
	    	$this->sendMedia('image', $url);
	    }

	    public function sendFile($url)
	    {
	    	$this->sendMedia('file', $url);
	    }

    	public function sendVideo($url)
	    {
	        $this->sendMedia('video', $url);
	    }

	    public function sendAudio($url)
	    {
	        $this->sendMedia('audio', $url);
	    }

	    public function createButtonToURL($title, $url, $setAttributes = NULL)
	    {
	        if ($this->isURL($url)) {
	            $button = array(
	            'type'  => 'web_url',
	            'url'   => $url,
	            'title' => $title,
	            );
	            
	            if (!is_null($setAttributes) && is_array($setAttributes)) {
	                $button['set_attributes'] = $setAttributes;
	            }
	            
	            return $button;
	        }
	        
	        return FALSE;
	    }


	    public function createButtonToBlock($title, $block, $setAttributes = NULL)
	    {
	        $button = array(
	        	'type' => 'show_block',
	        	'title' => $title
	        );
	        
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

	    public function createButtonShare()
	    {
	        return array(
	            'type' => 'element_share'
	        );
	    }
	    public function createButtonCall($phoneNumber, $title = 'Call')
	    {
	        return array(
	            'type' => 'phone_number',
	            'phone_number' => $phoneNumber,
	            'title' => $title
	        );
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
	    public function sendTextCard($text, $buttons)
	    {
	    	if(empty($buttons[0]['title']))
	    		$buttons = array($buttons);

            $this->sendAttachment('template', array(
                'template_type' => 'button',
                'text' => $text,
                'buttons' => $buttons
            ));
	    }

	    public function createElement($title, $image, $subTitle, $buttons)
		{
			if(empty($buttons[0]['type']))
				$buttons = array($buttons);

	        if ($this->isURL($image) && is_array($buttons)) {
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

            $this->sendAttachment('template', array(
                'template_type' => 'generic',
                'elements'      => $elements
            ));
	    }

	    public function sendList($elements, $topElementStyle = 'large')
	    {
			if(empty($elements[0]['title']))
	    		$elements = array($elements);

            $this->sendAttachment('template', array(
                'template_type'     => 'list',
                'top_element_style' => $topElementStyle,
                'elements'          => $elements
            ));
	    }

		public function __destruct()
		{
			$this->sentMessages();
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
				if ($this->isURL($value)) {
	            	$this->sendAttachment($type, array(
	                	'url' => $value
	            	));
	        	} else {
	            	$this->sendText('Error: Invalid URL!');
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
	        	$this->sendText('Error: Invalid type!');
	        }
	    }

		public function sentMessages()
		{
			if(is_null($this->messages))
				$this->sendText(NULL);
			if($this->debug){
				echo json_encode($this, JSON_PRETTY_PRINT);
			}else{
				echo json_encode($this);
			}
		}

	}