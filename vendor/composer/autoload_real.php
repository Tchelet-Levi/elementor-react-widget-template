<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit5c2f77c5f087c0325b5eaa10a3b566df
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInit5c2f77c5f087c0325b5eaa10a3b566df', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit5c2f77c5f087c0325b5eaa10a3b566df', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit5c2f77c5f087c0325b5eaa10a3b566df::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
