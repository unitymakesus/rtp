<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitaa3acace4531482e132095eacb9548bb
{
    public static $prefixLengthsPsr4 = array (
        'm' => 
        array (
            'mnelson4\\' => 9,
        ),
        'T' => 
        array (
            'Twine\\' => 6,
        ),
        'P' => 
        array (
            'PrintMyBlog\\' => 12,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'mnelson4\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/mnelson4',
        ),
        'Twine\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/Twine',
        ),
        'PrintMyBlog\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/PrintMyBlog',
        ),
    );

    public static $classMap = array (
        'PrintMyBlog\\compatibility\\DetectAndActivate' => __DIR__ . '/../..' . '/src/PrintMyBlog/compatibility/DetectAndActivate.php',
        'PrintMyBlog\\compatibility\\plugins\\EasyFootnotes' => __DIR__ . '/../..' . '/src/PrintMyBlog/compatibility/plugins/EasyFootnotes.php',
        'PrintMyBlog\\compatibility\\plugins\\LazyLoadingFeaturePlugin' => __DIR__ . '/../..' . '/src/PrintMyBlog/compatibility/plugins/LazyLoadingFeaturePlugin.php',
        'PrintMyBlog\\controllers\\PmbActivation' => __DIR__ . '/../..' . '/src/PrintMyBlog/controllers/PmbActivation.php',
        'PrintMyBlog\\controllers\\PmbAdmin' => __DIR__ . '/../..' . '/src/PrintMyBlog/controllers/PmbAdmin.php',
        'PrintMyBlog\\controllers\\PmbAjax' => __DIR__ . '/../..' . '/src/PrintMyBlog/controllers/PmbAjax.php',
        'PrintMyBlog\\controllers\\PmbCommon' => __DIR__ . '/../..' . '/src/PrintMyBlog/controllers/PmbCommon.php',
        'PrintMyBlog\\controllers\\PmbFrontend' => __DIR__ . '/../..' . '/src/PrintMyBlog/controllers/PmbFrontend.php',
        'PrintMyBlog\\controllers\\PmbGutenbergBlock' => __DIR__ . '/../..' . '/src/PrintMyBlog/controllers/PmbGutenbergBlock.php',
        'PrintMyBlog\\controllers\\PmbInit' => __DIR__ . '/../..' . '/src/PrintMyBlog/controllers/PmbInit.php',
        'PrintMyBlog\\controllers\\PmbPrintPage' => __DIR__ . '/../..' . '/src/PrintMyBlog/controllers/PmbPrintPage.php',
        'PrintMyBlog\\controllers\\Shortcodes' => __DIR__ . '/../..' . '/src/PrintMyBlog/controllers/Shortcodes.php',
        'PrintMyBlog\\domain\\FrontendPrintSettings' => __DIR__ . '/../..' . '/src/PrintMyBlog/domain/FrontendPrintSettings.php',
        'PrintMyBlog\\domain\\PrintButtons' => __DIR__ . '/../..' . '/src/PrintMyBlog/domain/PrintButtons.php',
        'PrintMyBlog\\domain\\PrintOptions' => __DIR__ . '/../..' . '/src/PrintMyBlog/domain/PrintOptions.php',
        'PrintMyBlog\\domain\\ProNotification' => __DIR__ . '/../..' . '/src/PrintMyBlog/domain/ProNotification.php',
        'Twine\\admin\\news\\DashboardNews' => __DIR__ . '/../..' . '/src/Twine/admin/news/DashboardNews.php',
        'Twine\\compatibility\\CompatibilityBase' => __DIR__ . '/../..' . '/src/Twine/compatibility/CompatibilityBase.php',
        'Twine\\controllers\\BaseController' => __DIR__ . '/../..' . '/src/Twine/controllers/BaseController.php',
        'Twine\\services\\display\\FormInputs' => __DIR__ . '/../..' . '/src/Twine/services/display/FormInputs.php',
        'mnelson4\\rest_api_detector\\RestApiDetector' => __DIR__ . '/../..' . '/src/mnelson4/rest_api_detector/RestApiDetector.php',
        'mnelson4\\rest_api_detector\\RestApiDetectorError' => __DIR__ . '/../..' . '/src/mnelson4/rest_api_detector/RestApiDetectorError.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitaa3acace4531482e132095eacb9548bb::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitaa3acace4531482e132095eacb9548bb::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitaa3acace4531482e132095eacb9548bb::$classMap;

        }, null, ClassLoader::class);
    }
}
