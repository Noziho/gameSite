<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc8bdb4d2c07466e93c1a3d7e92759ac9
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\Model\\Manager\\' => 18,
            'App\\Model\\Entity\\' => 17,
            'App\\Controller\\' => 15,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\Model\\Manager\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Model/Manager',
        ),
        'App\\Model\\Entity\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Model/Entity',
        ),
        'App\\Controller\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Controller',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc8bdb4d2c07466e93c1a3d7e92759ac9::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc8bdb4d2c07466e93c1a3d7e92759ac9::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitc8bdb4d2c07466e93c1a3d7e92759ac9::$classMap;

        }, null, ClassLoader::class);
    }
}
