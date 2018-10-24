<?php

return CMap::mergeArray(
    require(dirname(__FILE__) . '/main.php'),
    array(
        'language' => 'en',
        'components' => array(
            'urlManager' => array(
                'urlFormat' => 'path',
                'showScriptName' => false,
                'rules' => array(
                    '/'=>array('site/index', 'urlSuffix' => '/', 'caseSensitive' => false),
                    '/login-register'=>array('site/sign', 'urlSuffix' => '/', 'caseSensitive' => false),
                    '/search'=>array('site/search', 'urlSuffix' => '/', 'caseSensitive' => false),
                    '/about'=>array('site/about', 'urlSuffix' => '/', 'caseSensitive' => false),
                    '/contact'=>array('site/contact', 'urlSuffix' => '/', 'caseSensitive' => false),
                    '/terms-of-us'=>array('site/terms', 'urlSuffix' => '/', 'caseSensitive' => false),
                    '/privacy-policy'=>array('site/policy', 'urlSuffix' => '/', 'caseSensitive' => false),
                    '/profile'=>array('site/profile', 'urlSuffix' => '/', 'caseSensitive' => false),
                    '/profile-call-history'=>array('site/callhistory', 'urlSuffix' => '/', 'caseSensitive' => false),
                    '/profile-edit-competences'=>array('site/competences', 'urlSuffix' => '/', 'caseSensitive' => false),
                    '/profile-edit-languages'=>array('site/languages', 'urlSuffix' => '/', 'caseSensitive' => false),
                    '/profile-edit-cards'=>array('site/cards', 'urlSuffix' => '/', 'caseSensitive' => false),

                    '/api/register'=>array('api/register', 'urlSuffix' => '/', 'verb'=>'POST', 'caseSensitive' => false),
                    '/api/search'=>array('api/search', 'urlSuffix' => '/', 'verb'=>'GET', 'caseSensitive' => false),
                    '/api/login'=>array('api/login', 'urlSuffix' => '/', 'verb'=>'POST', 'caseSensitive' => false),
                    '/api/logout'=>array('api/logout', 'urlSuffix' => '/', 'verb'=>'POST', 'caseSensitive' => false),
                    '/api/profile'=>array('api/profile', 'urlSuffix' => '/', 'verb'=>'GET', 'caseSensitive' => false),
                    '/api/calls-history'=>array('api/calls_history', 'urlSuffix' => '/', 'verb'=>'GET', 'caseSensitive' => false),
                    '/api/languages'=>array('api/languages', 'urlSuffix' => '/', 'verb'=>'GET', 'caseSensitive' => false),
                    '/api/competences'=>array('api/competences', 'urlSuffix' => '/', 'verb'=>'GET', 'caseSensitive' => false),

                    '/api/setting-update'=>array('api/Setting_update', 'urlSuffix' => '/', 'verb'=>'PUT', 'caseSensitive' => false),
                    '/api/delete-call'=>array('api/Delete_call', 'urlSuffix' => '/', 'verb'=>'DELETE', 'caseSensitive' => false),
                    '/api/add-language'=>array('api/Add_language', 'urlSuffix' => '/', 'verb'=>'POST', 'caseSensitive' => false),
                    '/api/delete-language'=>array('api/Delete_language', 'urlSuffix' => '/', 'verb'=>'DELETE', 'caseSensitive' => false),
                    '/api/add-competence'=>array('api/Add_competence', 'urlSuffix' => '/', 'verb'=>'POST', 'caseSensitive' => false),
                    '/api/delete-competence'=>array('api/Delete_competence', 'urlSuffix' => '/', 'verb'=>'DELETE', 'caseSensitive' => false),







                    '<controller:\w+>/<id:\d+>' => '<controller>/view',
                    '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                    '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                ),
            ),
        )
    )
);
?>