<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.


// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::dashboard');

// Driver
$routes->get('/customer/sign-in', 'Customer\Login::index', ['filter' => 'auth_not_login_customer']);
$routes->get('/customer', 'Customer\Dashboard::index', ['filter' => 'auth_customer']);

$routes->get('/customer/orderan', 'Customer\Orderan::index', ['filter' => 'auth_customer']);

$routes->get('/customer/history', 'Customer\Orderan::history', ['filter' => 'auth_customer']);
$routes->get('/customer/history/detail/(:any)', 'Customer\Orderan::detail_history/$1', ['filter' => 'auth_customer']);

$routes->get('/customer/akun', 'Customer\Akun::index', ['filter' => 'auth_customer']);

$routes->get('/customer/logout', 'Logout::customer', ['filter' => 'auth_customer']);


// Personal Trainer
$routes->get('/personal-trainer/sign-in', 'PersonalTrainer\Auth::index', ['filter' => 'auth_not_login_personal_trainer']);
$routes->get('/personal-trainer/lupa-password', 'PersonalTrainer\Auth::lupa_password', ['filter' => 'auth_not_login_personal_trainer']);
$routes->get('/personal-trainer/reset-password/(:any)', 'PersonalTrainer\Auth::reset_password/$1', ['filter' => 'auth_not_login_personal_trainer']);
$routes->get('/personal-trainer', 'PersonalTrainer\Dashboard::index', ['filter' => 'auth_personal_trainer']);

$routes->get('/personal-trainer/order', 'PersonalTrainer\Order::index', ['filter' => 'auth_personal_trainer']);
$routes->post('/personal-trainer/order/submit-order', 'PersonalTrainer\Order::submit_order', ['filter' => 'auth_personal_trainer']);
$routes->get('/personal-trainer/order/edit/(:num)', 'PersonalTrainer\Order::edit/$1', ['filter' => 'auth_personal_trainer']);

$routes->get('/personal-trainer/history', 'PersonalTrainer\Order::history', ['filter' => 'auth_personal_trainer']);
$routes->get('/personal-trainer/history/detail/(:any)', 'PersonalTrainer\Order::detail_history/$1', ['filter' => 'auth_personal_trainer']);

$routes->get('/personal-trainer/akun', 'PersonalTrainer\Akun::index', ['filter' => 'auth_personal_trainer']);
$routes->get('/personal-trainer/logout', 'Logout::personal_trainer', ['filter' => 'auth_personal_trainer']);


// Fitness Center
$routes->get('/fitness-center/sign-in', 'AdminFitnessCenter\Auth::sign_in', ['filter' => 'auth_not_login_admin_fitness_center']);
$routes->get('/fitness-center/sign-up', 'AdminFitnessCenter\Auth::sign_up', ['filter' => 'auth_not_login_admin_fitness_center']);
$routes->get('/fitness-center/lupa-password', 'AdminFitnessCenter\Auth::lupa_password', ['filter' => 'auth_not_login_admin_fitness_center']);
$routes->get('/fitness-center/reset-password/(:any)', 'AdminFitnessCenter\Auth::reset_password/$1', ['filter' => 'auth_not_login_admin_fitness_center']);
$routes->get('/fitness-center', 'AdminFitnessCenter\Dashboard::index', ['filter' => 'auth_admin_fitness_center']);

$routes->get('/fitness-center/orderan', 'AdminFitnessCenter\Orderan::index', ['filter' => 'auth_admin_fitness_center']);
$routes->get('/fitness-center/orderan/detail/(:any)', 'AdminFitnessCenter\Orderan::detail/$1', ['filter' => 'auth_admin_fitness_center']);

$routes->get('/fitness-center/driver', 'AdminFitnessCenter\Driver::index', ['filter' => 'auth_admin_fitness_center']);
$routes->get('/fitness-center/customer', 'AdminFitnessCenter\Customer::index', ['filter' => 'auth_admin_fitness_center']);
$routes->get('/fitness-center/bandara', 'AdminFitnessCenter\Bandara::index', ['filter' => 'auth_admin_fitness_center']);

$routes->get('/fitness-center/logout', 'Logout::fitness_center', ['filter' => 'auth_admin_fitness_center']);




/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
