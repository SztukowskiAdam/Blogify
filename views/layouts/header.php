<!DOCTYPE HTML>
<html>
<head>
    <title>Blogify - najlepsze historie</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta charset="utf-8" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="Blogify to platforma do tworzenia artykułów. Znajdziemy dla Ciebie coś odpowiedniego!" />

    <link href="https://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/ckeditor5/12.1.0/classic/ckeditor.js"></script>
    <link type="text/css" rel="stylesheet" href="<?= \Kernel\Router::path('resources/assets/css/style.css')?>" />
    <link type="text/css" rel="stylesheet" href="<?= \Kernel\Router::path('resources/assets/css/layout.css')?>" />
    <link type="text/css" rel="stylesheet" href="<?= \Kernel\Router::path('resources/assets/css/navbar.css')?>" />
    <link type="text/css" rel="stylesheet" href="<?= \Kernel\Router::path('resources/assets/css/slider.css')?>" />
    <link type="text/css" rel="stylesheet" href="<?= \Kernel\Router::path('resources/assets/css/admin.css')?>" />
    <style>
        html, body {
            background-color: <?=$this->settings->backgroundColor?>;
            color: <?=$this->settings->textColor?>;
        }

        a {
            color: <?=$this->settings->linkColor?>;
        }

    </style>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <script src="<?= \Kernel\Router::path('resources/assets/js/jquery.js')?>"></script>
</head>
<body>
<?php
    include ('navbar.php');
?>