<?php
	abstract class dataAccessHandler{
		private $filename, $lastInsertID, $itemCount;

		public function __construct($filename){
			$this->filename = $filename;
			$lastInsertID = null;
			$this->countItems();
		}

		private function connect(){
			$dom = new DomDocument();
			$dom->load($this->filename);
			return $dom;
		}

		protected function updateXML($entity){ // provides interface for adding and updat
			$dom = $this->connect();
			$item = $dom->createElement('item');

			if(get_class($entity) == "CatalogItem"){
				$description 	= $dom->createElement('description', $entity->getDescription());
				$price 			= $dom->createElement('price', $entity->getPrice());
				$quantity 		= $dom->createElement('quantity', $entity->getQuantity());
				$image 			= $dom->createElement('image', $entity->getImage());
				$salePrice 		= $dom->createElement('salePrice', $entity->getSalePrice());

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
					$this->lastInsertID = count($items);
					$item->setAttribute( 'id', $this->lastInsertID );
					$dom->getElementsByTagName('catalog')->item(0)->appendChild($item);
				}
			}
			elseif(get_class($entity) == "SaleItem"){
				$dom->getElementsByTagName('sales')->item(0)->appendChild($item);
			}
			elseif(get_class($entity) == "CartItem"){
				$dom->getElementsByTagName('cart')->item(0)->appendChild($item);
			}
			
			$dom->save($this->filename);
			$this->countItems();

			return $this->getLastInsertID();
		}

		protected function delete($id){
			$dom = $this->connect();
			$element = $dom->getElementById($id);
			$dom->getElementsByTagName('catalog')->item(0)->removeChild($element);
			$dom->save($this->filename);
			$this->countItems();
		}

		protected function read($id = null){
			$dom = $this->connect();
			if(is_null($id)){ // get all items
				$results = $dom->getElementsByTagName('item');
			}
			else{ // get single item
				$results = $dom->getElementById($id);
			}
			
			return $this->returnArray($results);
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

		protected function countItems(){
			$dom = $this->connect();
			$items = $dom->getElementsByTagName('item');
			$this->itemCount = count($items);
		}

		private function returnArray($domList){
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