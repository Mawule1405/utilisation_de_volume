<?php

const DB_DSN = 'mysql:host=localhost;dbname=ing';
const DB_USER = 'ing';
const DB_PASS = 'ing';

$options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false
);