<?php
	abstract class BaseController{
		protected $urlValues;
		protected $action;

		public function __construct($action, $urlValues){
			$this->action = $action;
			$this->urlValues = $urlValues;
		}

		public function executeAction(){
			return $this->{$this->action}(); // call function named after what is in action
		}
	}
?>