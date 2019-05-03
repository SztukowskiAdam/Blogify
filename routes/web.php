<?php
namespace Routes;

use Kernel\Router;

Router::get('/', 'HomeController@index');
Router::get('admin/login', 'UsersController@login');
Router::post('admin/attempt', 'UsersController@attempt');
Router::get('admin/dashboard', 'UsersController@dashboard');
Router::get('admin/logout', 'UsersController@logout');