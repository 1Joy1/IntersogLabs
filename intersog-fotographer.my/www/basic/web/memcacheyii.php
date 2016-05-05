<?php

/*$memcache = new Memcache;
$memcache->connect('127.0.0.1', 11211) or die ("Could not connect");


echo 'Memcache ver: ' . $memcache->getVersion() . '<br>';



//создать ключ, затем проверить кэш
$key = "AlexAlex";

$get_result = $memcache->get($key);

//if ($get_result) {
    ?><pre><?php print_r($memcache->getExtendedStats('items')); ?><pre><?php
    echo "<br>";
    ?><pre><?php print_r($memcache->getExtendedStats('slabs')); ?><pre><?php
    echo "<br>";
    echo "Данные из кеша";
//} else {
//     echo "Кеш пуст";
//}
*/


/**
* Function to get all memcache keys
* @author Manish Patel
* @Created:  28-May-2010 
*/
function getMemcacheKeys() {

    $memcache = new Memcache;
    $memcache->connect('127.0.0.1', 11211) or die ("Could not connect to memcache server");

    $list = array();
    $allSlabs = $memcache->getExtendedStats('slabs');
    
    ?><pre><?php //var_dump($allSlabs); ?><pre><?php
    //echo '<br>';
    
    $items = $memcache->getExtendedStats('items');
    foreach($allSlabs as $server => $slabs) {
        foreach($slabs as $slabId => $slabMeta) {
            $cdump = $memcache->getExtendedStats('cachedump',(int)$slabId);
            foreach($cdump as $keys => $arrVal) {
                if (!is_array($arrVal)) continue;
                foreach($arrVal as $k => $v) { 
                    $list[$k] = array(
                        'key' => $k,//ключ
                        'server' => $server,
                        'slabId' => $slabId,
                        'detail' => $v,
                        'age' => $items[$server]['items'][$slabId]['age']
                    );
                    
                }
            }
        }
    }   
    ?><pre><?php print_r($list); ?><pre><?php
} getMemcacheKeys();
