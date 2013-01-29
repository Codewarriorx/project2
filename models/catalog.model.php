<?php
	class CatalogModel extends dataAccessHandler{

		public function __construct(){
			parent::__construct("catalog.xml");
		}

		public function __destruct(){
			parent::__destruct();
		}

		public function getListing($lowerBound, $upperBound){
			$listing = array();
			for ($i=$lowerBound; $i < $upperBound; $i++) { 
				$item = $this->read("item_$i");
				$tempEntity = new CatalogItem($item['name'], $item['description'], $item['price'], $item['quantity'], $item['image'], $item['salePrice'], $item['id']);
				array_push($listing, $tempEntity);
			}
			return $listing;
		}
	}
?>