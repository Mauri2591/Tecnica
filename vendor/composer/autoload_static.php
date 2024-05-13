<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf5b49e7a7c599e2292805fc03fed3c50
{
    public static $prefixLengthsPsr4 = array (
        'U' => 
        array (
            'U633419\\Tecnica\\' => 16,
        ),
        'T' => 
        array (
            'Tests\\PhpOffice\\Math\\' => 21,
        ),
        'S' => 
        array (
            'Spatie\\PdfToImage\\' => 18,
        ),
        'P' => 
        array (
            'PhpOffice\\PhpWord\\' => 18,
            'PhpOffice\\Math\\' => 15,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'U633419\\Tecnica\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'Tests\\PhpOffice\\Math\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpoffice/math/tests/Math',
        ),
        'Spatie\\PdfToImage\\' => 
        array (
            0 => __DIR__ . '/..' . '/spatie/pdf-to-image/src',
        ),
        'PhpOffice\\PhpWord\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpoffice/phpword/src/PhpWord',
        ),
        'PhpOffice\\Math\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpoffice/math/src/Math',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf5b49e7a7c599e2292805fc03fed3c50::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf5b49e7a7c599e2292805fc03fed3c50::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitf5b49e7a7c599e2292805fc03fed3c50::$classMap;

        }, null, ClassLoader::class);
    }
}