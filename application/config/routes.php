<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
// Default diarahkan ke login
$route['default_controller'] = 'Auth/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Routes untuk login & logout
$route['login'] = 'Auth/index';               // Form login
$route['login/process'] = 'Auth/login';      // Proses login
$route['logout'] = 'Auth/logout';

// Routes untuk forgot password (GET + POST di-handle di controller)
$route['forgot-password'] = 'Auth/forgotPassword';

// Routes untuk register pelanggan
$route['register'] = 'Auth/registerForm';     // Form register
$route['register/process'] = 'Auth/register'; // Proses register

/*
| -------------------------------------------------------------------------
| Admin Routes (authAdmin di-handle di constructor controller)
| -------------------------------------------------------------------------
*/

// Dashboard
$route['admin/dashboard'] = 'Admin/Dashboard/index';

// CRUD Pelanggan
$route['admin/pelanggan'] = 'Admin/Pelanggan/index';
$route['admin/pelanggan/create'] = 'Admin/Pelanggan/create';
$route['admin/pelanggan/store'] = 'Admin/Pelanggan/store';
$route['admin/pelanggan/edit/(:any)'] = 'Admin/Pelanggan/edit/$1';
$route['admin/pelanggan/update/(:any)'] = 'Admin/Pelanggan/update/$1';
$route['admin/pelanggan/delete/(:any)'] = 'Admin/Pelanggan/delete/$1';
$route['admin/pelanggan/(:any)'] = 'Admin/Pelanggan/$1';
$route['admin/pelanggan/(:any)/(:any)'] = 'Admin/Pelanggan/$1/$2';
$route['admin/pelanggan/import_excel'] = 'Admin/Pelanggan/import_excel';
$route['admin/pelanggan/do_import'] = 'Admin/Pelanggan/do_import';



// CRUD Banner
$route['admin/banner'] = 'Admin/Banner/index';
$route['admin/banner/create'] = 'Admin/Banner/create';
$route['admin/banner/store'] = 'Admin/Banner/store';
$route['admin/banner/edit/(:any)'] = 'Admin/Banner/edit/$1';
$route['admin/banner/update/(:any)'] = 'Admin/Banner/update/$1';
$route['admin/banner/delete/(:any)'] = 'Admin/Banner/delete/$1';

// Halaman utama kelola layanan + FAQ
$route['admin/layanan'] = 'Admin/Layanan/index';
$route['admin/layanan/update'] = 'Admin/Layanan/update';

// CRUD FAQ
$route['admin/layanan/faq/create'] = 'Admin/Layanan/createFaq';
$route['admin/layanan/faq/store'] = 'Admin/Layanan/storeFaq';
$route['admin/layanan/faq/edit/(:num)'] = 'Admin/Layanan/editFaq/$1';
$route['admin/layanan/faq/update/(:num)'] = 'Admin/Layanan/updateFaq/$1';
$route['admin/layanan/faq/delete/(:num)'] = 'Admin/Layanan/deleteFaq/$1';

// CRUD Data Pengguna
$route['admin/user'] = 'Admin/User/index';
$route['admin/user/create'] = 'Admin/User/create';
$route['admin/user/store'] = 'Admin/User/store';
$route['admin/user/edit/(:any)'] = 'Admin/User/edit/$1';
$route['admin/user/update/(:any)'] = 'Admin/User/update/$1';
$route['admin/user/delete/(:any)'] = 'Admin/User/delete/$1';
$route['admin/user/(:any)'] = 'Admin/User/$1';
$route['admin/user/(:any)/(:any)'] = 'Admin/User/$1/$2';

/*
| -------------------------------------------------------------------------
| Pelanggan Routes (authPelanggan di-handle di constructor controller)
| -------------------------------------------------------------------------
*/

$route['pelanggan/dashboard'] = 'Pelanggan/Dashboard/index';
$route['pelanggan/promo'] = 'Pelanggan/Dashboard/promo';

$route['pelanggan/speedtest'] = 'Pelanggan/Dashboard/speedtest';

// Profil & Ubah Password
$route['pelanggan/profile'] = 'Pelanggan/Profile/index';
$route['pelanggan/profile/updatePassword'] = 'Pelanggan/Profile/updatePassword';
