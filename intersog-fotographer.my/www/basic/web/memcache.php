<?php

$memcache = new Memcache;
$memcache->connect('127.0.0.1', 11211) or die ("Could not connect");


echo 'Memcache ver: ' . $memcache->getVersion() . '<br>';


include('connect.php');


$query="SELECT * FROM users where role='photographer'";

//создать ключ, затем проверить кэш
$key = md5($query);

$get_result = $memcache->get($key);

if ($get_result) {
    ?><b><i><pre><?php print_r($get_result); ?><pre><?php
    echo "<br>";
   /* echo $get_result['name'];
    echo "<br>";
    echo $get_result['role'];
    echo "<br>";
    echo "<br>";*/
    echo "Data Pulled From Cache</i></b>";
} else {
    // Получить данные из базы и создать кэш    
    $result = mysql_query($query);
    $rowArr = array();
    while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
    array_push($rowArr, $row);
 }
    ?><pre><?php print_r($rowArr); ?></pre><?php
   
    $memcache->set($key, $rowArr, MEMCACHE_COMPRESSED, 20); // Хранить результат 20 секунд
    
     echo "Data Pulled from the Database";
}
