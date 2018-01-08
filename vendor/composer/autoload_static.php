<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitafc6ddb807eb4a17be261b2554d98f9d
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Core\\' => 5,
            'Config\\' => 7,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Core\\' => 
        array (
            0 => __DIR__ . '/../..' . '/core',
        ),
        'Config\\' => 
        array (
            0 => __DIR__ . '/../..' . '/config',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitafc6ddb807eb4a17be261b2554d98f9d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitafc6ddb807eb4a17be261b2554d98f9d::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
