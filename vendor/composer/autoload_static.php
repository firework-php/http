<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6cf165d30f9dec2571a79a3d91ad0bd6
{
    public static $prefixLengthsPsr4 = array (
        'H' => 
        array (
            'Http\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Http\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit6cf165d30f9dec2571a79a3d91ad0bd6::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6cf165d30f9dec2571a79a3d91ad0bd6::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit6cf165d30f9dec2571a79a3d91ad0bd6::$classMap;

        }, null, ClassLoader::class);
    }
}
