<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit3afa8c0a8f4dfa7ffb5468bf3a31b1c0
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'Administrator\\QueryLog\\' => 23,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Administrator\\QueryLog\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit3afa8c0a8f4dfa7ffb5468bf3a31b1c0::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit3afa8c0a8f4dfa7ffb5468bf3a31b1c0::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit3afa8c0a8f4dfa7ffb5468bf3a31b1c0::$classMap;

        }, null, ClassLoader::class);
    }
}
