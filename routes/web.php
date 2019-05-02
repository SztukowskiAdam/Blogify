<?php
namespace Routes;

use Kernel\Router;

Router::get('/', 'HomeController@index');
Router::get('users', 'UsersController@index');
Router::get('users/create', 'UsersController@create');
Router::get('users/edit/:id', 'UsersController@edit');