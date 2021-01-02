<?php
/**
 * Importe automatiquement les models et controlleurs.
 *
 * @package Core
 * @author Maxime Bernard
 * @version 1
 */

namespace App;

/**
 * Class Autoloader
 */
class AutoLoader
{
    public static function register()
    {
        spl_autoload_register([
            __CLASS__,
            'autoload'
        ]);
    }

    public static function autoload($class){
        $class = str_replace(array(__NAMESPACE__ . '\\', '\\'), array('', '/'), $class);
        if(file_exists(__DIR__ . '/' . $class . '.php')){
            require __DIR__ . '/' . $class . '.php';
        }
    }
}

