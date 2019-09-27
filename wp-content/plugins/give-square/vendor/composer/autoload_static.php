<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit76d00d334cc2b025331a3d5a83b04eb9
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'SquareConnect\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'SquareConnect\\' => 
        array (
            0 => __DIR__ . '/..' . '/square/connect/lib',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit76d00d334cc2b025331a3d5a83b04eb9::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit76d00d334cc2b025331a3d5a83b04eb9::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}