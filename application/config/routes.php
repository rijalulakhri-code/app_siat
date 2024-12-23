<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'welcome';
$route['form'] = 'Main_controller/index';
$route['process'] = 'Main_controller/process';


$route['wilayah/get_provinsi'] = 'main_controller/get_provinsi';
$route['wilayah/get_kabupaten/(:num)'] = 'main_controller/get_kabupaten/$1';
$route['wilayah/get_kecamatan/(:num)'] = 'main_controller/get_kecamatan/$1';
$route['wilayah/get_desa/(:num)'] = 'main_controller/get_desa/$1';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
