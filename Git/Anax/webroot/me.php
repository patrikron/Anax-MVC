<?php

require __DIR__.'/config_with_app.php'; 
 
$app->url->setUrlType(\Anax\Url\CUrl::URL_CLEAN); 
 
$app->router->add('', function() use ($app) {
 
});
 
$app->router->add('redovisning', function() use ($app) {
  	$app->theme->setTitle("Redovisning");
    $app->views->add('me/redovisning');
});
 
$app->router->add('source', function() use ($app) {
 
});
 
 
$app->navbar->configure(ANAX_APP_PATH . 'config/navba_me.php');
$app->theme->configure(ANAX_APP_PATH . 'config/theme_me.php');
$app->router->handle();
$app->theme->render();