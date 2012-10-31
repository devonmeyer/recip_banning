<?php
/**
 * Created by JetBrains PhpStorm.
 * User: devon
 * Date: 10/30/12
 * Time: 7:44 PM
 * To change this template use File | Settings | File Templates.
 */

require 'vendor/autoload.php';

$app = new \Slim\Slim();

$app->get("/", function(){
echo "WTF man";
});


$app->get('/hello/:name', function ($name) {
    echo "Hello, $name";
});

$app->run();

//echo "Hello there!!!!";



