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

function getCategorieProdotti()
{
    return select("SELECT * FROM categorie_prodotti WHERE attivo = 1");
}

function checkUniqueSlugCategoria($slug, $idCategoria = null)
{
    $query = "SELECT * FROM categorie_prodotti WHERE slug = '" . enc($slug) . "'";
    if (!empty($idCategoria)) {
        $query .= " AND id != '" . enc($idCategoria) . "'";
    }
    
    return selectFirst($query);
}

function getCategoriaById($id)
{
    return selectFirst("SELECT * FROM categorie_prodotti WHERE id = '" . enc($id) . "'");
}
