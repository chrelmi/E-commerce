<?php

include_once dirname(__DIR__) . '/inc/config.php';

global $dbhandle;
$dbhandle = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($dbhandle->connect_errno) {
    die("Impossibile connettersi al database: " . $dbhandle->connect_error);
}

function select()
{
    
}

function selectFirst()
{
    
}

function esegui()
{
    
}