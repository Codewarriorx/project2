<?php
	abstract class dataAccessHandler{
		private $filename, $lastInsertID, $itemCount;

		public function __construct($filename){
			$this->filename = $filename;
			$lastInsertID = 0;
			$this->countItems();
			if($this->itemCount != 0){
				$this->setLastInsertID();
			}
		}

		public function __destruct(){

		}

		private function connect(){
			$dom = new DomDocument();
			// $dom->validateOnParse = true;
			$dom->load($this->filename);
			return $dom;
		}

		protected function updateXML($entity){ // provides interface for adding and update
			$dom = $this->connect();
			$item = $dom->createElement('item');

			if(get_class($entity) == "CatalogItem"){
				$name 			= $dom->createElement('name', $entity->getName());
				$description 	= $dom->createElement('description', $entity->getDescription());
				$price 			= $dom->createElement('price', $entity->getPrice());
				$quantity 		= $dom->createElement('quantity', $entity->getQuantity());
				$image 			= $dom->createElement('image', $entity->getImage());
				$salePrice 		= $dom->createElement('salePrice', $entity->getSalePrice());

				$item->appendChild($name);
				$item->appendChild($description);
				$item->appendChild($price);
				$item->appendChild($quantity);
				$item->appendChild($image);
				$item->appendChild($salePrice);

				if(!is_null( $entity->getID() )){ // update
					$oldItem = $dom->getElementById($entity->getID());
					$item->setAttribute( 'id', $entity->getID() );
					$dom->getElementsByTagName('catalog')->item(0)->replaceChild($item, $oldItem);
				}
				else{ // create
					$this->countItems();
					$id = $this->lastInsertID + 1;
					$item->setAttribute( 'id', "item_".$id );
					$dom->getElementsByTagName('catalog')->item(0)->appendChild($item);
				}
			}
			elseif(get_class($entity) == "SaleItem"){
				$itemID = $dom->createElement('itemID', $entity->getItemID());

				$item->appendChild($itemID);

				if(!is_null( $entity->getID() )){ // update
					$oldItem = $dom->getElementById($entity->getID());
					$item->setAttribute( 'id', $entity->getID() );
					$dom->getElementsByTagName('sales')->item(0)->replaceChild($item, $oldItem);
				}
				else{ // create
					$this->countItems();
					$id = $this->lastInsertID + 1;
					$item->setAttribute( 'id', "sale_".$id );
					$dom->getElementsByTagName('sales')->item(0)->appendChild($item);
				}
			}
			elseif(get_class($entity) == "CartItem"){
				$itemID = $dom->createElement('itemID', "item_".$entity->getItemID());

				$item->appendChild($itemID);
				if(!is_null($this->itemExistsInCart($entity->getItemID()) )){ // update
					$oldItem = $dom->getElementById( $this->itemExistsInCart($entity->getItemID()) );
					$item->setAttribute( 'id', $this->itemExistsInCart($entity->getItemID()) );

					$prevQuantity = $oldItem->getElementsByTagName('quantity')->item(0)->nodeValue;
					$count = $prevQuantity + $entity->getCount();

					$quantity = $dom->createElement('quantity', $count);
					$item->appendChild($quantity);
					
					$dom->getElementsByTagName('cart')->item(0)->replaceChild($item, $oldItem);
				}
				else{ // create
					$quantity = $dom->createElement('quantity', $entity->getCount());
					$item->appendChild($quantity);
					$this->countItems();
					
					$id = $this->lastInsertID + 1;
					$item->setAttribute( 'id', "cart_".$id );
					
					$dom->getElementsByTagName('cart')->item(0)->appendChild($item);
				}
			}
			
			$dom->save($this->filename);
			$lastInsertID = $this->getItemCount();
			$this->countItems();$this->setLastInsertID();

			return $lastInsertID;
		}

		protected function itemExistsInCart($itemID){
			$dom = $this->connect();
			$items = $dom->getElementsByTagName('item');
			for ($i=0; $i < $items->length; $i++) {
				$node = $items->item($i);
				$value = $node->getElementsByTagName('itemID')->item(0);
				if($value->nodeValue == "item_".$itemID){
					$parentNode = $value->parentNode;
					return $parentNode->getAttribute('id');
				}
			}
			return null;
		}

		protected function itemExistsOnSale($itemID){
			$dom = $this->connect();
			$items = $dom->getElementsByTagName('itemID');
			for ($i=0; $i < $items->length; $i++) {
				if($items->item($i)->nodeValue == $itemID){
					return true;
				}
			}
			return false;
		}

		protected function delete($itemType, $id){
			$dom = $this->connect();
			$elementToRemove = null;
			$elements = $dom->getElementsByTagName('itemID');
			for ($i=0; $i < $elements->length; $i++) { 
				if($elements->item($i)->nodeValue == $id){
					$elementToRemove = $elements->item($i)->parentNode;
					break;
				}
			}

			$dom->getElementsByTagName($itemType)->item(0)->removeChild($elementToRemove);
			$dom->save($this->filename);
			$this->countItems();
		}

		protected function read($id = null){
			$dom = $this->connect();
			if(is_null($id)){ // get all items
				$results = $dom->getElementsByTagName('item');
				$results = $this->nodeListToArray($results);
			}
			else{ // get single item
				$results = $dom->getElementById($id);
				if(is_null($results)){
					return null;
				}
				$results = $this->nodeToArray($results);
			}
			
			return $results;
		}

		protected function getLastInsertID(){
			return $this->lastInsertID;
		}

		public function getItemCount(){
			return $this->itemCount;
		}

		public function checkForItem($id){
			$dom = $this->connect();
			$item = $dom->getElementById($id);
			if(is_null($item)){
				return false;
			}
			else{
				return true;
			}
		}

		private function setLastInsertID(){
			$dom = $this->connect();
			$lastItem = $dom->getElementsByTagName('item')->item($this->itemCount - 1);
			$id = $lastItem->getAttribute('id');
			$array = explode('_', $id);
			$this->lastInsertID = $array[1];
		}

		protected function countItems(){
			$dom = $this->connect();
			$items = $dom->getElementsByTagName('item');
			$this->itemCount = $items->length;
		}

		private function nodeToArray($domNode){
			$nodeList = $domNode->childNodes;
			$tempArray = array();
			foreach ($nodeList as $part) {
				$tempArray[$part->nodeName] = $part->nodeValue;
			}
			$tempArray['id'] = $domNode->getAttribute('id');
			
			return $tempArray;
		}

		private function nodeListToArray($domList){
			$arrayList = array();
			foreach ($domList as $domItem) { // goes through each item
				$tempArray = array();
				foreach ($domItem->childNodes as $part) {
					$tempArray[$part->nodeName] = $part->nodeValue;
				}
				$tempArray['id'] = $domItem->getAttribute('id');
				array_push($arrayList, $tempArray);
			}
			return $arrayList;
		}

		protected function sanitize($string){
			$string = trim($string);
			$string = stripslashes($string);
			$string = htmlentities($string);
			$string = strip_tags($string);
			return $string;
		}
	}
?>