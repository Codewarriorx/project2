<?php
	class CatalogModel extends dataAccessHandler{

		public function __construct(){
			parent::__construct("catalog.xml");
		}

		public function __destruct(){
			parent::__destruct();
		}

		/**
		 * Takes in a collection of entities (cart or sales) and returns catalog entities in thier place
		 *
		 * @param list $entities
		 */
		public function getCatalogItems($entities){
			$catalogEntities = array();
			foreach ($entities as $entity) {
				$itemID = $entity->getItemID();
				$item = $this->read($itemID);
				$tempEntity = new CatalogItem($item['name'], $item['description'], $item['price'], $item['quantity'], $item['image'], $item['salePrice'], $item['id']);
				array_push($catalogEntities, $tempEntity);
			}

			return $catalogEntities;
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