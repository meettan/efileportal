<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
|	https://codeigniter.com/userguide3/general/routing.html
|   RESERVED ROUTES
|	$route['404_override'] = 'errors/page_missing';
|	$route['translate_uri_dashes'] = FALSE;
|   Examples:	my-controller/index	-> my_controller/index
|   my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Auth';
//$route['dispach'] = 'dispach/dis';
$route['dispach'] = "dispach/dis";
$route['dispach/(:any)'] = "dispach/dis/$1";
$route['transaction'] = "transaction/transaction";
$route['transaction/(:any)'] = "transaction/transaction/$1";
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
