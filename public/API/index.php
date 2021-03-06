<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
require '../../vendor/autoload.php';

try {
    $config['displayErrorDetails'] = true;
    $app = new \Slim\App(["settings" => $config]);
    $container = $app->getContainer();

    $container['db'] = function ($c) {
        $db = $c['settings']['db'];
        
        // $pdo = new pdo( 'mysql:host=104.131.116.194;port=3306;dbname=vnmedeiros_vnmedeiros',
        //                 'vnmedeiros',
        //                 '9u7a8abe4',
        //                 array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        
        $pdo = new pdo( 'mysql:host=db;port=3306;dbname=database',
                        'user',
                        'password',
                        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        
        //$pdo = new PDO("pgsql:host=" . $db['host'] . ";port=" . $db['port'] . ";dbname=" . $db['dbname'] . ";user=" . $db['user'] . ";password=" . $db['pass']);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    };

    $dir = '../../app/routes';
    foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS)) as $file){	
        require $file;  
    }

    $app->run();
} catch (Exception $ex) {
    echo $ex;
}
?>
