<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf75fc1e21cb7c1cb72f13dbaa59de365
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf75fc1e21cb7c1cb72f13dbaa59de365::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf75fc1e21cb7c1cb72f13dbaa59de365::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitf75fc1e21cb7c1cb72f13dbaa59de365::$classMap;

        }, null, ClassLoader::class);
    }
}