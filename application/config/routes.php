<?php


defined('BASEPATH') OR exit('No direct script access allowed');

//povrzuvanje so posts/create
$route['posts/create'] = 'posts/create';
$route['posts/update'] = 'posts/update';
//ruta za post/slug od bazata
$route['posts/(:any)'] = 'posts/view/$1';
//post index
$route['posts'] = 'posts/index';

//pages views
$route['default_controller'] = 'pages/view';
$route['(:any)'] = 'pages/view/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
//pages/view