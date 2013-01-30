<?php
	define("PAGE", "home");
	class Home extends BaseController{
		public function index(){
			// get page numbers for both sales and catalog

			$catalogModel = new CatalogModel();
			$catalogPagination = new Pagination($catalogModel->getItemCount(), 8);
			if(isset($urlValues['catPage'])){
				$pageNumber = $urlValues['catPage'];
				$bounds = $catalogPagination->paginate($pageNumber);
			}
			else{
				$bounds = $catalogPagination->paginate();
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
			$saleEntities = $salesModel->getListing($bounds['lowerBound'], $bounds['upperBound']);
			$salesListing = $catalogModel->getCatalogItems($saleEntities);

			return new IndexView($catalogListing, $catalogPagination, $salesListing, $salesPaginator);
		}
	}
?>