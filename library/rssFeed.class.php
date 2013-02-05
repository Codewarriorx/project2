<?php
	class RssFeed{
		private $rssFile;
		
		public function __construct($filename) {
			$this->rssFile = $filename;
		}
		
		//This function would be used AFTER updating the catalog file in your admin.php script
		public function replaceRSS($catalogEntities) {
			$dom = new DOMDocument('1.0');
			$rssElement = $dom->createElement('rss');
			$rssElement->setAttribute('version', '2.0');

			$channel = $dom->createElement('channel');

			$channel->appendChild( $dom->createElement('title', 'Project2 RSS Feed') );
			$channel->appendChild( $dom->createElement('title', 'http://people.rit.edu/mjl7592/539/project2/project2.rss') );
			$channel->appendChild( $dom->createElement('description', 'Project 2 RSS Feed') );

			foreach ($catalogEntities as $entity) {
				$item = $dom->createElement('item');
				$item->appendChild( $dom->createElement('title', $entity->getName()) );
				$item->appendChild( $dom->createElement('link', 'http://people.rit.edu/mjl7592/539/project2/item/index/'.str_replace('item_', '', $entity->getID())) );
				$item->appendChild( $dom->createElement('description', $entity->getDescription()) );
				$item->appendChild( $dom->createElement('price', $entity->getprice()) );
				$item->appendChild( $dom->createElement('salePrice', $entity->getSalePrice()) );
				$item->appendChild( $dom->createElement('pubDate', ''.getdate() ) );
				$channel->appendChild($item);
			}
			$rssElement->appendChild($channel);
			$dom->appendChild($rssElement);
			$dom->save($this->rssFile);
		}
	}
?>