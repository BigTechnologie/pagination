<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit1dab878e660b8228756830202b6e8730
{
    public static $files = array (
        '48483d6c44b015b6d6d681c009d084a7' => __DIR__ . '/../..' . '/src/helpers.php',
    );

    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit1dab878e660b8228756830202b6e8730::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit1dab878e660b8228756830202b6e8730::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit1dab878e660b8228756830202b6e8730::$classMap;

        }, null, ClassLoader::class);
    }
}