<?php 

class Autoloader
{
    public static function register($rootPath)
    {
        spl_autoload_register(function ($class) use ($rootPath) {
            $file = str_replace('\\', DIRECTORY_SEPARATOR, $class).'.php';
            if (file_exists($rootPath . $file)) {
                require_once $rootPath . $file;
                return true;
            }else {
                return false;
            }
        });
    }
}