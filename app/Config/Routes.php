<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('lobby', 'Controlador::index');
$routes->get('Agregar', 'Controlador::Agregar');
$routes->post('guardar', 'Controlador::guardar');
$routes->get('borrar/(:num)', 'Controlador::borrar/$1');
$routes->get('editar/(:num)', 'Controlador::editar/$1');
$routes->post('actualizar', 'Controlador::actualizar');