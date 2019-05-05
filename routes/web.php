<?php
namespace Routes;

use Kernel\Router;

Router::get('/', 'HomeController@index');
Router::get('articles', 'ArticlesController@index');
Router::get('articles/:slug', 'ArticlesController@show');

/* ADMIN */
Router::get('admin/login', 'AdminController@login');
Router::post('admin/attempt', 'AdminController@attempt');
Router::get('admin/dashboard', 'AdminController@dashboard');
Router::get('admin/logout', 'AdminController@logout');
Router::get('admin/articles', 'ArticlesController@adminIndex');
Router::get('admin/articles/edit/:id', 'ArticlesController@edit');