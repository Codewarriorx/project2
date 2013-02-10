<?php
	define("PAGE", "services");
	class Services extends BaseController{
		public function index(){
			$urls = array();
			$dom = new DomDocument();
			$dom->load("rss_class.xml");
			$students = $dom->getElementsByTagName('student');

			for ($i=0; $i < $students->length; $i++) { 
				if($this->followed($i)){
					$url = $students->item($i)->getElementsByTagName('url')->item(0)->nodeValue;
					array_push($urls, $url);
				}
			}
			return new IndexView($urls);
		}

		function followed($number){
			$follow = new DomDocument();
			$follow->load("follow.xml");
			$students = $follow->getElementsByTagName('student');

			foreach ($students as $student) {
				if($student->nodeValue == $number){
					return true;
				}
			}

			return false;
		}
	}
?>