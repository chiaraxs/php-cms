<?php

$db['db_host'] = 'localhost';
$db['db_user'] = 'root';
$db['db_password'] = 'root';
$db['db_name'] = 'cms';


foreach($db as $key => $value){
    define(strtoupper($key), $value);
}

// DB CONNECTION
$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// if($connection) {
//     echo "Database connesso!";
// }

?> 