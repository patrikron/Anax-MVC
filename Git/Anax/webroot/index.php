<?php

require __DIR__.'/config_with_app.php'; 
 
$app->url->setUrlType(\Anax\Url\CUrl::URL_CLEAN); 
 
//Home
$app->router->add('', function() use ($app) {
	 $app->theme->setTitle("Hem");
	 
	 $aboutme = $app->fileContent->get('aboutme.md');
	 $aboutme = $app->textFilter->doFilter($aboutme, 'shortcode, markdown');
	 $app->views->add('me/aboutme', [
		'content' => $aboutme,
    ]);
	 
	 
	 $byline = $app->fileContent->get('byline.md');
	 $byline = $app->textFilter->doFilter($byline, 'shortcode, markdown');
	 $app->views->add('me/byline', [
		'byline' => $byline,
    ]);
});

//Report 
$app->router->add('redovisning', function() use ($app) {
  	$app->theme->setTitle("Redovisning");
	
	$content = $app->fileContent->get('report.md');
	$content = $app->textFilter->doFilter($content, 'shortcode, markdown');
 
 	$byline = $app->fileContent->get('byline.md');
	$byline = $app->textFilter->doFilter($byline, 'shortcode, markdown');
 
    $app->views->add('me/redovisning', [
        'content' => $content,
    ]);
	
	$app->views->add('me/byline', [
		'byline' => $byline,
    ]);
});
 
 //Source 
$app->router->add('source', function() use ($app) {
 	$app->theme->setTitle("Källkod");
	$app->theme->addStylesheet('css/source.css');
 
    $source = new \Mos\Source\CSource([
        'secure_dir' => '..', 
        'base_dir' => '..', 
        'add_ignore' => ['.htaccess'],
    ]);
 
    $app->views->add('me/source', [
        'content' => $source->View(),
    ]);
});
 
 
$app->navbar->configure(ANAX_APP_PATH . 'config/navbar_me.php');
$app->theme->configure(ANAX_APP_PATH . 'config/theme_me.php');

$app->router->handle();
$app->theme->render();