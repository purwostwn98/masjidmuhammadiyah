<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Landing::index');
$routes->post('landing/dinamis/load_peta', 'Landing::dinamis_load_peta');
