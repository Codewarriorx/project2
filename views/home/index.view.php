<?php
	class IndexView{
		private $catalogEntityList, $catPagination, $saleEntityList, $salePagination;

		public function __construct($catalogEntityList, $catPagination, $saleEntityList, $salePagination){
			$this->catalogEntityList = $catalogEntityList;
			$this->catPagination = $catPagination;
			$this->saleEntityList = $saleEntityList;
			$this->salePagination = $salePagination;
		}

		public function render(){
			$this->buildSection("Sales!", "salePage", "");
			$this->buildSection("Catalog", "catPage", "mainSection");
		}

		private function buildSection($header, $pageType, $sectionClasses){
			if($pageType == "salePage"){
				$entityList = $this->saleEntityList;
				$paginationObject = $this->salePagination;
			}
			elseif($pageType == "catPage"){
				$entityList = $this->catalogEntityList;
				$paginationObject = $this->catPagination;
			}

			$items = "";
			$pagination = "";
			foreach ($entityList as $entity) {
				ob_start();
				$values = $entity->toArray();
				include("templates/index/mainItem.tpl.php");
				$content = ob_get_clean();
				$items .= $content;
			}
			
			for ($pageNumber=1; $pageNumber <= $paginationObject->pageCount(); $pageNumber++) {
				$classes = "";
				if($paginationObject->getCurrentPage() == $pageNumber){
					$classes = "active";
				}
				ob_start();
				include("templates/index/pagination.tpl.php");
				$content = ob_get_clean();
				$pagination .= $content;
			}
			include("templates/index/mainSection.tpl.php");
		}

		public function itemDescriptionLimited($description, $length){
			return substr($description,0,$length)."...";
		}
	}
?>