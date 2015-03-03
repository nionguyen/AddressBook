<?php

///WAY 1///
//define("AP_SITE", "localhost/AddressBook/");
/*
spl_autoload_register(function ($class_name) {
	//List all the class directories in the array.
    $array_paths = array(
		'Contact/',
        'Database/',
		'Database/Adapter/',
		'User/'
    );

	$file_name = ($class_name).'.php';

    for ($i = 0; $i < count($array_paths); $i++) 
    {
		//$path = AP_SITE.$array_paths[$i].$file_name;
		$path = $_SERVER['DOCUMENT_ROOT']."/AddressBook/".$array_paths[$i].$file_name;
        if(file_exists($path)) 
        {
            require_once $path;
        }
    }
});
*/

///WAY 2///

spl_autoload_register(function ($class_name) {
	$class = $_SERVER['DOCUMENT_ROOT']."/AddressBook/".str_replace('\\', '/', strtolower($class_name)).".php";
	if (is_readable($class))
	{
			require_once $class;
	}
});

?>