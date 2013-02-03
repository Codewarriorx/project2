<?
	class Loader{
		private $controller;
		private $action;
		private $urlValues;

		public function __construct($urlValues){
			$this->urlValues = $urlValues;

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

		public static function libLoader($class){
		    $filename = lcfirst($class) . '.class.php';
		    $file ='library/' . $filename;
		    if (!file_exists($file)){
		        return false;
		    }
		    include $file;
		}

		public static function entityLoader($class){
		    $filename = lcfirst($class) . '.entity.php';
		    $file ='entities/' . $filename;
		    if (!file_exists($file)){
		        return false;
		    }
		    include $file;
		}

		public static function modelLoader($class){
			$class = str_replace('Model', '', $class);
		    $filename = lcfirst($class) . '.model.php';
		    $file ='models/' . $filename;
		    if (!file_exists($file)){
		        return false;
		    }
		    include $file;
		}

		public static function controllerLoader($class){
		    $filename = lcfirst($class) . '.controller.php';
		    $file ='controllers/' . $filename;
		    if (!file_exists($file)){
		        return false;
		    }
		    include $file;
		}

		public static function viewLoader($class){
			$controller = "";
			if(!isset($_GET['controller'])){ // Set controller
				$controller = "home";
			}
			else{
				$controller = $_GET['controller'];
			}

			$class = str_replace('View', '', $class);
		    $filename = lcfirst($class) . '.view.php';
		    $file ='views/' . $controller . '/' . $filename;
		    if (!file_exists($file)){
		        return false;
		    }
		    include $file;
		}
	}
?>