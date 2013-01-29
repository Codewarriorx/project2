<?php
	class Home extends BaseController{
		public $PAGE = 'Home';

		public function index(){
			// get page numbers for both sales and catalog

			$catalogModel = new CatalogModel();
			$mainPaginator = new Pagination($catalogModel->getItemCount(), 8);
			if(isset($urlValues['catPage'])){
				$pageNumber = $urlValues['catPage'];
				$bounds = $mainPaginator->paginate($pageNumber);
			}
			else{
				$bounds = $mainPaginator->paginate();
			}
			$catalogListing = $catalogModel->getListing($bounds['lowerBound'], $bounds['upperBound']);

			$salesModel = new SalesModel();
			$salesPaginator = new Pagination($salesModel->getItemCount(), 4);
			if(isset($urlValues['salePage'])){
				$pageNumber = $urlValues['salePage'];
				$bounds = $salesPaginator->paginate($pageNumber);
			}
			else{
				$bounds = $salesPaginator->paginate();
			}
			$salesListing = $salesModel->getListing($bounds['lowerBound'], $bounds['upperBound']);

			return new IndexView($catalogListing, $catalogPagination, $salesListing, $salePagination);
		}
	}
?>