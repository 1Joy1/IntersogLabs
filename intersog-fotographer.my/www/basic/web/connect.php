<?php

$link = mysql_connect('localhost', 'root', '')
    or die( 'Не удалось соединиться с БД');
    
mysql_select_db('intersoglabs2') or die('Не удалось выбрать базу данных');