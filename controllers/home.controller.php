<?php
	class Home extends BaseController{
		public $PAGE = 'Home';

		public function index(){
			$catalogModel = new CatalogModel();
			$mainPaginator = new Pagination($catalogModel->getItemCount(), 8);
			if(isset($urlValues['page'])){
				$pageNumber = $urlValues['page'];
				$bounds = $mainPaginator->paginate($pageNumber);
			}
			else{
				$bounds = $mainPaginator->paginate();
			}
			$listing = $catalogModel->getListing($bounds['lowerBound'], $bounds['upperBound']);

			return new IndexView($listing);
		}
	}
?>