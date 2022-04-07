<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit9d68b01716d5390a01acee655ca7846c
{
    public static $prefixLengthsPsr4 = array (
        'H' => 
        array (
            'Hrmisapi\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Hrmisapi\\' => 
        array (
            0 => __DIR__ . '/..' . '/mdridzuan80/hrmisapi/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit9d68b01716d5390a01acee655ca7846c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit9d68b01716d5390a01acee655ca7846c::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}