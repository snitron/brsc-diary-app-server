<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitdeecd950229a7e0d0890a19f3901cf77
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Snoopy\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Snoopy\\' => 
        array (
            0 => __DIR__ . '/..' . '/pherum/snoopy/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'S' => 
        array (
            'Sunra\\PhpSimple\\HtmlDomParser' => 
            array (
                0 => __DIR__ . '/..' . '/sunra/php-simple-html-dom-parser/Src',
            ),
        ),
    );

    public static $classMap = array (
        'Callback' => __DIR__ . '/..' . '/electrolinux/phpquery/phpQuery/phpQuery/Callback.php',
        'CallbackBody' => __DIR__ . '/..' . '/electrolinux/phpquery/phpQuery/phpQuery/Callback.php',
        'CallbackParam' => __DIR__ . '/..' . '/electrolinux/phpquery/phpQuery/phpQuery/Callback.php',
        'CallbackParameterToReference' => __DIR__ . '/..' . '/electrolinux/phpquery/phpQuery/phpQuery/Callback.php',
        'CallbackReturnReference' => __DIR__ . '/..' . '/electrolinux/phpquery/phpQuery/phpQuery/Callback.php',
        'CallbackReturnValue' => __DIR__ . '/..' . '/electrolinux/phpquery/phpQuery/phpQuery/Callback.php',
        'DOMDocumentWrapper' => __DIR__ . '/..' . '/electrolinux/phpquery/phpQuery/phpQuery/DOMDocumentWrapper.php',
        'DOMEvent' => __DIR__ . '/..' . '/electrolinux/phpquery/phpQuery/phpQuery/DOMEvent.php',
        'ICallbackNamed' => __DIR__ . '/..' . '/electrolinux/phpquery/phpQuery/phpQuery/Callback.php',
        'phpQuery' => __DIR__ . '/..' . '/electrolinux/phpquery/phpQuery/phpQuery.php',
        'phpQueryEvents' => __DIR__ . '/..' . '/electrolinux/phpquery/phpQuery/phpQuery/phpQueryEvents.php',
        'phpQueryObject' => __DIR__ . '/..' . '/electrolinux/phpquery/phpQuery/phpQuery/phpQueryObject.php',
        'phpQueryObjectPlugin_Scripts' => __DIR__ . '/..' . '/electrolinux/phpquery/phpQuery/phpQuery/plugins/Scripts.php',
        'phpQueryObjectPlugin_WebBrowser' => __DIR__ . '/..' . '/electrolinux/phpquery/phpQuery/phpQuery/plugins/WebBrowser.php',
        'phpQueryObjectPlugin_example' => __DIR__ . '/..' . '/electrolinux/phpquery/phpQuery/phpQuery/plugins/example.php',
        'phpQueryPlugin_Scripts' => __DIR__ . '/..' . '/electrolinux/phpquery/phpQuery/phpQuery/plugins/Scripts.php',
        'phpQueryPlugin_WebBrowser' => __DIR__ . '/..' . '/electrolinux/phpquery/phpQuery/phpQuery/plugins/WebBrowser.php',
        'phpQueryPlugin_example' => __DIR__ . '/..' . '/electrolinux/phpquery/phpQuery/phpQuery/plugins/example.php',
        'phpQueryPlugins' => __DIR__ . '/..' . '/electrolinux/phpquery/phpQuery/phpQuery.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitdeecd950229a7e0d0890a19f3901cf77::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitdeecd950229a7e0d0890a19f3901cf77::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInitdeecd950229a7e0d0890a19f3901cf77::$prefixesPsr0;
            $loader->classMap = ComposerStaticInitdeecd950229a7e0d0890a19f3901cf77::$classMap;

        }, null, ClassLoader::class);
    }
}
