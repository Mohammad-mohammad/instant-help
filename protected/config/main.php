<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
Yii::setPathOfAlias('bootstrap', dirname(__FILE__) . '/../extensions/bootstrap');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Instant Help',
    'theme' => 'default',
    // preloading 'log' component
    'preload' => array('log', 'bootstrap'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.helpers.*',
        'ext.galleryManager.*',
        'ext.galleryManager.models.*',
        'ext.image.*',
        'application.modules.auth.*',
        'ext.easyimage.EasyImage',
    ),
    'behaviors' => array(
        'runEnd' => array(
            'class' => 'application.components.WebApplicationEndBehavior',
        ),
    ),
    'modules' => array(
        'auth' => array(
            'strictMode' => true, // when enabled authorization items cannot be assigned children of the same type.
            'userClass' => 'User', // the name of the user model class.
            'userIdColumn' => 'id', // the name of the user id column.
            'userNameColumn' => 'name', // the name of the user name column.
            'appLayout' => '//layouts/main', // the layout used by the module.
            'viewDir' => null, // the path to view files to use with this module.
        ),
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => '1',
            'generatorPaths' => array('bootstrap.gii', 'bootstrap.gii2',),
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
        ),
    ),
    // application components
    'components' => array(
        'authManager' => array(
            'behaviors' => array(
                'auth' => array(
                    'class' => 'auth.components.AuthBehavior',
                    'admins' => array('superAdmin'), // users with full access
                ),
            ),
        ),
        'user' => array(
            'allowAutoLogin' => true,
            //'authTimeout'=>180,
            'class' => 'auth.components.AuthWebUser',
        ),
        'image' => array(
            'class' => 'application.extensions.image.CImageComponent',
            // GD or ImageMagick
            'driver' => 'GD',
            // ImageMagick setup path
            'params' => array('directory' => '/opt/local/bin'),
        ),
        'easyImage' => array(
            'class' => 'application.extensions.easyimage.EasyImage',
            //'driver' => 'GD',
            //'quality' => 100,
            //'cachePath' => '/assets/easyimage/',
            //'cacheTime' => 2592000,
            //'retinaSupport' => false,
        ),
        'ControllerMap' => array(
            'Image' => array('class' => 'vendor.crisu83.yii-imagemanager.controllers.ImageController'),
            'Gallery' => array('class' => 'ext.galleryManager.GalleryController'),
        ),
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=instanthelpdb',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            // uncomment the following to show log messages on web pages
            /*
              array(
              'class'=>'CWebLogRoute',
              ),
             */
            ),
        ),
    ),
    // using Yii::app()->params['paramName']
    'params' => array(
        'superAdmin' => '0932961329',
        'adminEmail' => 'info@instanthelp.com',
        'thumb_w' => '123',
        'thumb_h' => '93',
    ),
);
