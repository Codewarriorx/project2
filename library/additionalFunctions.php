<?php
	$password = 'project2';

	function activePage($page='home'){
		
		if($page == PAGE){
			return "active";
		}
	}

	/*
	*	This is to recreate lcfirst function that is available in newer versions of php
	*/
	function lcfirst( $str ){
		return (string)(strtolower(substr($str,0,1)).substr($str,1));
	} 
?>