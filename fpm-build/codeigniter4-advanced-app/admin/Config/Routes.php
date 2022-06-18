<?php

$routes->add('admin', '\Admin\Controllers\Home::index');
$routes->add('admin/login', '\Admin\Controllers\Login::index');
$routes->add('admin/logout', '\Admin\Controllers\Logout::index');