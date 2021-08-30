<?php

include_once dirname(__DIR__) . '/inc/config.php';
include_once ROOT_PATH . '_class/query.php';

session_start();

/**
 * Verifica l'effettivo login per l'utente SUPER_USER
 * @return bool
 */
function checkLoginGestione()
{
    return checkLogin(RUOLO_SUPER_USER);
}

/**
 * Verifica il login per il ruolo richiesto
 * @param int $idRuolo
 * @return boolean
 */
function checkLogin($idRuolo)
{
    return isset($_SESSION['user']) && !empty($_SESSION['user']) && $_SESSION['user']['id_ruolo'] == $idRuolo;
}

function getUtente()
{
    return $_SESSION['user'];
}