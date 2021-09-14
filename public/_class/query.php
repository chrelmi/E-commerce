<?php

include_once dirname(__DIR__) . '/inc/config.php';
include_once ROOT_PATH . '_class/functions.php';

/**
 * @var mysqli
 */
global $dbhandle;
$dbhandle = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($dbhandle->connect_errno) {
    die("Impossibile connettersi al database: " . $dbhandle->connect_error);
}

/**
 * Funzione utilizzata per l'estrazione dei dati
 * @param string $query
 * @return array
 */
function select($query) {
    global $dbhandle;
    
    $return = [];
    
    if ($query != "") {
        $que = $dbhandle->query($query);
        if ($que) {
            for ($i=0; $i < $que->num_rows; $i++) {
                $dati = $que->fetch_assoc();
                $return[$i] = $dati;
            }
        } else {
            $return = array("ERRORE", $dbhandle->error);
        }
    }
    return $return;
}


/**
 * Funzione utilizzata per l'estrazione del singolo record
 * @param string $query
 * @return array
 */
function selectFirst($query)
{
    global $dbhandle;
    $result = $dbhandle->query($query);
    return $result ? $result->fetch_assoc() : [];
}

/**
 * Funzione utilizzata per le operazioni nel database,
 * Ad esempio insert, update e delete.
 * @param string $query
 * @return bool
 */
function esegui($query) :bool
{
    global $dbhandle;
    
    if (empty($query)) {
        return false;
    }
    
    return $dbhandle->query($query);
}

/**
 * Funzione utilizzata per la sanificazione dei dati del db
 * @param string $str
 * @return string
 */
function enc($str)
{
    global $dbhandle;
    return $dbhandle->escape_string(trim($str));
}

