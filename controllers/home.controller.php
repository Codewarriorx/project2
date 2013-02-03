<?php
	define("PAGE", "home");
	class Home extends BaseController{
		public function index(){
			$catalogModel = new CatalogModel();
			if(isset($_GET['catPage'])){
				$catalogPagination = new Pagination($catalogModel->getItemCount(), 8, $_GET['catPage']);
				$pageNumber = $_GET['catPage'];
				$bounds = $catalogPagination->paginate($pageNumber);
			}
			else{
				$catalogPagination = new Pagination($catalogModel->getItemCount(), 8);
				$bounds = $catalogPagination->paginate();
			}
			$catalogListing = $catalogModel->getListing($bounds['lowerBound'], $bounds['upperBound']);

			$salesModel = new SalesModel();
			if(isset($_GET['salePage'])){
				$salesPaginator = new Pagination($salesModel->getItemCount(), 4, $_GET['salePage']);
				$pageNumber = $_GET['salePage'];
				$bounds = $salesPaginator->paginate($pageNumber);
			}
			else{
				$salesPaginator = new Pagination($salesModel->getItemCount(), 4);
				$bounds = $salesPaginator->paginate();
			}
			$saleEntities = $salesModel->getListing($bounds['lowerBound'], $bounds['upperBound']);
			$salesListing = $catalogModel->getCatalogItems($saleEntities);

			return new IndexView($catalogListing, $catalogPagination, $salesListing, $salesPaginator);
		}
	}
?>