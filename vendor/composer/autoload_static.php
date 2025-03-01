<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit1e3ff67127ab35acc7c7bade713511d3
{
    public static $prefixLengthsPsr4 = array (
        'Z' => 
        array (
            'Zauta\\Backend\\' => 14,
        ),
        'T' => 
        array (
            'Types\\' => 6,
        ),
        'G' => 
        array (
            'GraphQL\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Zauta\\Backend\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'Types\\' => 
        array (
            0 => __DIR__ . '/../..' . '/graphql/types',
        ),
        'GraphQL\\' => 
        array (
            0 => __DIR__ . '/..' . '/webonyx/graphql-php/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit1e3ff67127ab35acc7c7bade713511d3::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit1e3ff67127ab35acc7c7bade713511d3::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit1e3ff67127ab35acc7c7bade713511d3::$classMap;

        }, null, ClassLoader::class);
    }
}
