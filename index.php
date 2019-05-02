<?php

use Kernel\Bootstrap;

/**
 * Autoloading classes
 */
spl_autoload_register(function ($className) {
   if (file_exists('Kernel/'.$className.'.php')) {
       require_once 'Kernel/'.$className.'.php';

   } else if (file_exists('Controllers/'.$className.'.php')) {
       require_once 'Controllers/'.$className.'.php';

   } else if (file_exists('Models/'.$className.'.php')) {
       require_once 'Models/'.$className.'.php';

   } else if (file_exists($className.'.php')) {
       require_once $className.'.php';
   }
});

new Bootstrap();