<?php

return CMap::mergeArray(
    require(dirname(__FILE__) . '/main.php'), array(
        'theme' => 'admin',
        // preloading 'log' component
        //'preload' => array('log', 'bootstrap'),
        //'sourceLanguage'=>'ar',
        'language' => 'en',
        'components' => array(
            'bootstrap' => array(
                'class' => 'bootstrap.components.Bootstrap',
                //'bootstrapCss'=>false,
            ),
            //'clientScript' => array('scriptMap' => array('jquery.js'=>'http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js','jquery-ui.min.js' => 'http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js'))
            'clientScript' => array('scriptMap' => array(
                'bootstrap.min.css' => FALSE,
                'bootstrap.css' => FALSE,
                //'jquery.min.js'=> FALSE,
                //'bootstrap.min.js'=> FALSE,
            ))
            // 'urlManager' => array(
            //'urlFormat' => 'path',
            //'showScriptName' => false,
            //'caseSensitive'=>false,
            //'rules' => array(
            //'backend' => 'admin/login',
            //'backend/<_c>' => '<_c>',
            //'backend/<_c>/<_a>' => '<_c>/<_a>',
            //),
            //),
        )
    )
);
?>