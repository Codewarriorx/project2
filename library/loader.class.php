<?
	class Loader{
		private $controller;
		private $action;
		private $urlValues;

		public function __construct($urlValues){
			$this->urlValues;

			if($this->urlValues['controller'] == ""){ // Set controller
				$this->controller = "home";
			}
			else{
				$this->controller = $this->urlValues['controller'];
			}

			if($this->urlValues['action'] == ""){ // Set action
				$this->action = "index";
			}
			else{
				$this->action = $this->urlValues['action'];
			}
		}

		public function createController(){
			if(class_exists($this->controller)){ // Does the class exist?
				$parents = class_parents($this->controller);

				if(in_array("BaseController", $parents)){ // Does the class extend the controller class?
					if(method_exists($this->controller, $this->action)){ // Does the class contain the requested method?
						return new $this->controller($this->action, $this->urlValues);
					}
					else{ // Bad method error
						return new Error("badUrl", $this->urlValues);
					}
				}
				else{ // Bad controller error
					return new Error("badUrl", $this->urlValues);
				}
			}
			else{ // Bad controller error
				return new Error("badUrl", $this->urlValues);
			}
		}
	}
?>