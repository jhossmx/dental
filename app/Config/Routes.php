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

/* ******************************************************************************* */
// Rutas del Site
/* ******************************************************************************* */
$routes->get('/', 'SiteController::index', ['as' => 'home']);
$routes->get('about', 'SiteController::about', ['as' => 'about']);
$routes->get('services', 'SiteController::services', ['as' => 'services']);
$routes->get('contact', 'SiteController::contact', ['as' => 'contact']);
$routes->get('appointment', 'SiteController::appointment', ['as' => 'appointment']);

//dashboard principal del modulo usuario
$routes->get('principal', 'Principal::index', ['as' => 'principal', 'filter' => 'auth']);


$routes->group('pacientes', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
    //listado de pacientes
    $routes->get('/', 'Pacientes::index', ['as' => 'pacientes', 'filter' => 'auth']);//ruta del listado de pacientes
    //$routes->get('getDataPacientes', 'Pacientes::getDataPacientes', ['as' => 'getDataPacientes', 'filter' => 'auth']);//ruta del listado de pacientes
    $routes->get('getDataPacientes', 'Pacientes::list', ['as' => 'getDataPacientes', 'filter' => 'auth']);//ruta del listado de pacientes
});



/* ******************************************************************************* */
// Rutas del modulo Administrador
/* ******************************************************************************* */
$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
    
   
    //login del modulo admin
    $routes->get('/', 'Login::index', ['as' => 'admin_login']);//ruta del login del Admin
    //$routes->get('login', 'Login::index', ['as' => 'admin_login']);//ruta del login del Admin
    $routes->post('valida', 'Login::validalogin', ['as' => 'admin_valida']); //validacion del admin
    $routes->get('logout', 'Login::logout', ['as' => 'admin_logout']); //ruta para salir del modulo usuario
    
    //configuracion del sistema
    $routes->get('configuracion', 'Config::index', ['as' => 'configuracion', 'filter' => 'auth']);


    $routes->get('calendario', 'Calendar::index', ['as' => 'calendario', 'filter' => 'auth']);
    $routes->get('loadDataCalendar', 'Calendar::loadDataCalendar', ['as' => 'loadDataCalendar', 'filter' => 'auth']);
    $routes->post('getCalendarData', 'Calendar::getCalendarData', ['as' => 'getCalendarData', 'filter' => 'auth']);
    $routes->post('insertDataDay', 'Calendar::insertDataDay', ['as' => 'insertDataDay', 'filter' => 'auth']);
    $routes->post('insertDataCalendar', 'Calendar::insertDataCalendar', ['as' => 'insertDataCalendar', 'filter' => 'auth']);
    $routes->post('upInsertDataCalendar', 'Calendar::upInsertDataCalendar', ['as' => 'upInsertDataCalendar', 'filter' => 'auth']);
    $routes->post('updateDataCalendar', 'Calendar::updateDataCalendar', ['as' => 'updateDataCalendar', 'filter' => 'auth']);
    $routes->post('deleteDataCalendar', 'Calendar::deleteDataCalendar', ['as' => 'deleteDataCalendar', 'filter' => 'auth']);

    //rutas de los usuarios
    //$routes->get('usuarios', 'Usuarios::index', ['as' => 'usuarios', 'filter' => 'auth']);
    //$routes->post('ajaxusuarios', 'Usuarios::ajaxusuarios', ['as' => 'ajaxusuarios', 'filter' => 'auth']);
    //$routes->get('nuevoUsuario', 'Usuarios::crear', ['as' => 'nuevoUsuario', 'filter' => 'auth']);
    //$routes->post('grabarUsaurio', 'Usuarios::grabar', ['as' => 'grabarUsaurio', 'filter' => 'auth']);
    //$routes->get('usuario/(:num)', 'Usuarios::consultar/$1', ['as' => 'consultaUsuario', 'filter' => 'auth']);
    //$routes->post('cambiarestadousuario', 'Usuarios::cambiarEstadoUsuario', ['as' => 'cambiarEstadoUsuario', 'filter' => 'auth']);
    //$routes->add('blog', 'Admin\Blog::index');

    //rutas de los periodos
    //$routes->get('periodos', 'Periodos::index', ['as' => 'periodos', 'filter' => 'auth']);
    //$routes->post('grabarperiodo', 'Periodos::grabar', ['as' => 'grabarPeriodo', 'filter' => 'auth']);
    
 });

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
