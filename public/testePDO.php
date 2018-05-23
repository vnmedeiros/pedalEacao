<?php
try{
    //$dbh = new pdo( 'mysql:host=localhost;dbname=pedaleacao',
    //                'root',
    //                'vnm',
    //                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	// $dbh = new pdo( 'mysql:host=104.131.116.194;port=3306;dbname=vnmedeiros_vnmedeiros',
    //                 'vnmedeiros',
    //                 '9u7a8abe4',
    //                 array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $dbh = new pdo( 'mysql:host=db;port=3306;dbname=database',
                    'user',
                    'password',
                    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    die(json_encode(array('outcome' => true)));
}
catch(PDOException $ex){
    print $ex;
    die(json_encode(array('outcome' => false, 'message' => 'Unable to connect')));
}
?>
