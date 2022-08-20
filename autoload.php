<?php 

spl_autoload_register( function($path) {
    
	$name = str_replace('\\','/' ,$path);
	$name = __DIR__ .'/src/'.$name.'.php';
// 		var_dump($name);die();
	if (is_file($name)) {
	    require_once($name);
	}else {
	    require_once __DIR__ . '/vendor/autoload.php'; 
	}
    
});