<?php
	class Pagination{
		private $numberOfItems, $itemsPerPage, $currentPage;

		public function __construct($numberOfItems, $itemsPerPage, $currentPage="1"){
			$this->numberOfItems = $numberOfItems;
			$this->itemsPerPage = $itemsPerPage;
		}

		public function pageCount(){
			return ceil($this->numberOfItems / $this->itemsPerPage);
		}

		public function getCurrentPage(){
			return $this->currentPage;
		}

		public function paginate($page="1"){
			$page--;
			$lowerBound = $page * $this->itemsPerPage;
			$upperBound = $lowerBound + $this->itemsPerPage;

			if($upperBound > $this->numberOfItems){
				$upperBound = $this->numberOfItems;
			}

			return array("lowerBound" => $lowerBound, "upperBound" => $upperBound);
		}
	}
?>