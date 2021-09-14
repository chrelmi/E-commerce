<?php

include_once dirname(__DIR__) . '/inc/config.php';

function getRuoliUtenti()
{
    return select("SELECT * FROM utenti_ruoli WHERE attivo = 1");
}

function getUtenteById($id)
{
    return selectFirst("SELECT * FROM utenti WHERE id = '" . enc($id) . "'");
}

function checkUniqueEmailUtente($email, $idUtente = null)
{
    $query = "SELECT * FROM utenti WHERE email = '" . enc($email) . "'";
    if (!empty($idUtente)) {
        $query .= " AND id != '" . enc($idUtente) . "'";
    }
    return selectFirst($query);
}