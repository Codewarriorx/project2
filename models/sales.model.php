<?php
	class SalesModel extends dataAccessHandler{

		public function __construct(){
			parent::__construct("sales.xml");
		}

		public function __destruct(){
			parent::__destruct();
		}

		public function getListing($lowerBound, $upperBound){
			$listing = array();
			for ($i=$lowerBound; $i < $upperBound; $i++) { 
				$item = $this->read("sale_$i");
				$tempEntity = new SaleItem($item['itemID'], $item['id']);
				array_push($listing, $tempEntity);
			}
			return $listing;
		}

		public function getAll(){
			$listing = array();
			for ($i=0; $i < $this->getItemCount(); $i++) { 
				$item = $this->read("sale_$i");
				$tempEntity = new SaleItem($item['itemID'], $item['id']);
				array_push($listing, $tempEntity);
			}
			return $listing;
		}

		public function onSale($itemID){
			return $this->itemExistsOnSale($itemID);
		}

		public function putOnSale(){
			$entity = new SaleItem($itemID);
			$this->updateXML($entity);
		}
	}
?>