<?php
	class IndexView{
		private $followedUrls;

		public function __construct($followedUrls){
			$this->followedUrls = $followedUrls;
		}

		public function render(){
			$content = "";
			foreach ($this->followedUrls as $value) {
				$dom = new DomDocument();
				$dom->load($value);
				$items = $dom->getElementsByTagName('item');
				$length = $items->length;

				if($length > 0){
					if($length > 2){
						$length = 2;
					}

					for ($i=0; $i < $length; $i++) { 
						$name = $items->item($i)->getElementsByTagName('title')->item(0)->nodeValue;
						$link = $items->item($i)->getElementsByTagName('link')->item(0)->nodeValue;
						$description = $items->item($i)->getElementsByTagName('description')->item(0)->nodeValue;
						$price = $items->item($i)->getElementsByTagName('salePrice')->item(0)->nodeValue;
						ob_start();
						include("templates/services/mainItem.tpl.php");
						$content .= ob_get_clean();
					}
				}
			}
			include("templates/services/mainSection.tpl.php");
		}

		public function itemDescriptionLimited($description, $length){
			return substr($description,0,$length)."...";
		}
	}
?>