<?php
namespace Routes;

use Kernel\Router;

Router::get('/', 'HomeController@index');
Router::get('articles', 'HomeController@index');
Router::get('articles/:slug', 'HomeController@show');

/* ADMIN */
Router::get('admin/login', 'Admin\AdminController@login');
Router::post('admin/attempt', 'Admin\AdminController@attempt');
Router::get('admin/dashboard', 'Admin\AdminController@dashboard');
Router::get('admin/logout', 'Admin\AdminController@logout');
Router::get('admin/articles', 'Admin\ArticlesController@adminIndex');
Router::get('admin/articles/create', 'Admin\ArticlesController@create');
Router::post('admin/articles/save', 'Admin\ArticlesController@save');
Router::get('admin/articles/edit/:id', 'Admin\ArticlesController@edit');
Router::get('admin/articles/delete/:id', 'Admin\ArticlesController@delete');