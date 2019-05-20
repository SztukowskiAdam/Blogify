<?php
namespace Routes;

use Kernel\Router;

Router::get('/', 'HomeController@index');
Router::get('articles', 'HomeController@articles');
Router::get('articles/rate', 'ArticlesController@rateArticle');
Router::get('articles/:slug', 'HomeController@show');
Router::post('articles/:slug', 'ArticlesController@addComment');

/* USER */
Router::get('login', 'UsersController@login');
Router::get('register', 'UsersController@register');
Router::post('register', 'UsersController@storeUser');
Router::post('login', 'UsersController@attempt');
Router::get('logout', 'UsersController@logout');
Router::get('users/articles', 'UsersController@index');
Router::get('users/articles/create', 'ArticlesController@create');
Router::post('users/articles/create', 'ArticlesController@store');

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
Router::get('admin/settings', 'Admin\SettingsController@edit');
Router::post('admin/settings', 'Admin\SettingsController@save');