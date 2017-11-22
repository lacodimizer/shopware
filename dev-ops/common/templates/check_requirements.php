<?php
/**
 * very small check for needed server requirements
 */

if (!version_compare(PHP_VERSION, '7.1', '>=')) {
    throw new Exception('you need a php version 7.1 or higher');
}

$db = new PDO('mysql:host=__DB_HOST__;port=__DB_PORT__;', '__DB_USER__', '__DB_PASSWORD__');

$mysqlVersion = $db->query('SELECT VERSION();')->fetchColumn();

if (!version_compare($mysqlVersion, '5.7', '>=')) {
    throw new Exception('you need a mysql version 5.7 or higher');
}

$mysqlGroupConcat = $db->query('SHOW VARIABLES LIKE "group_concat_max_len"')->fetchColumn(1);
if ($mysqlGroupConcat < 320000) {
    throw new Exception('MySQL parameter "group_concat_max_len" must be at least 320000.');
}