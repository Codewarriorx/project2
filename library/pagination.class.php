<?php
	class Pagination{
		private $numberOfItems, $itemsPerPage;

		public function __construct($numberOfItems, $itemsPerPage){
			$this->numberOfItems = $numberOfItems;
			$this->itemsPerPage = $itemsPerPage;
		}

		public function pageCount(){
			return ceil($this->numberOfItems / $this->itemsPerPage);
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