<?php

require_once dirname(__DIR__) . '/inc/config.php';
require_once ROOT_PATH . '_class/query.php';
require_once ROOT_PATH . '_class/session.php';

if (empty($_POST['azione'])) {
    header('Location: ' . GESTIONE);
    exit();
}

switch ($_POST['azione']) {
    case 'nuovo':
        
        if (empty($_POST['descrizione']) || empty($_POST['slug'])) {
            //todo: exit_back();
        }
        
        if (!empty(checkUniqueSlugCategoria($_POST['slug']))) {
            $_SESSION['notifica'] = [
                'type' => 'error',
                'title' => 'Attenzione!',
                'text' => 'Impossibile utilizzare questo permalink!'
            ];
            header('Location: ' . GESTIONE . 'gestione-categorie-prodotti.php');
            exit();
        }
        
        $idPadre = !empty($_POST['id_padre']) ? "'" . enc($_POST['id_padre']) . "'" : "NULL";
        $title = !empty($_POST['title']) ? "'" . enc($_POST['title']) . "'" : "NULL";
        $description = !empty($_POST['description']) ? "'" . enc($_POST['description']) . "'" : "NULL";
        $keywords = !empty($_POST['keywords']) ? "'" . enc($_POST['keywords']) . "'" : "NULL";
        
        $query = "
            INSERT INTO
                categorie_prodotti
            SET
                id_padre = " . $idPadre . ",
                descrizione = '" . enc($_POST['descrizione']) . "',
                slug = '" . enc($_POST['slug']) . "',
                title = " . $title . ",
                keywords = " . $keywords . ",
                description = " . $description . ",
                attivo = 1
        ";
        $result = esegui($query);
        if (!$result) {
            //todo: exit_back();
        }
        
        $_SESSION['notifica'] = [
            'type' => 'success',
            'title' => 'Complimenti!',
            'text' => 'Cateogoria prodotto creata correttamente'
        ];
        header('Location: ' . GESTIONE . 'gestione-categorie-prodotti.php');
        break;
        exit();
        
    case 'modifica':
        
        if (empty($_POST['descrizione']) || empty($_POST['slug']) || empty($_POST['id_categoria'])) {
            //todo: exit_back();
        }
        
        if (!empty(checkUniqueSlugCategoria($_POST['slug'], $_POST['id_categoria']))) {
            $_SESSION['notifica'] = [
                'type' => 'error',
                'title' => 'Attenzione!',
                'text' => 'Impossibile utilizzare questo permalink!'
            ];
            header('Location: ' . GESTIONE . 'gestione-categorie-prodotti.php');
            exit();
        }
        
        $idPadre = !empty($_POST['id_padre']) ? "'" . enc($_POST['id_padre']) . "'" : "NULL";
        $title = !empty($_POST['title']) ? "'" . enc($_POST['title']) . "'" : "NULL";
        $description = !empty($_POST['description']) ? "'" . enc($_POST['description']) . "'" : "NULL";
        $keywords = !empty($_POST['keywords']) ? "'" . enc($_POST['keywords']) . "'" : "NULL";
        
        $query = "
            UPDATE
                categorie_prodotti
            SET
                id_padre = " . $idPadre . ",
                descrizione = '" . enc($_POST['descrizione']) . "',
                slug = '" . enc($_POST['slug']) . "',
                title = " . $title . ",
                keywords = " . $keywords . ",
                description = " . $description . "
            WHERE
                id = '" . enc($_POST['id_categoria']) . "'
        ";
        $result = esegui($query);
        if (!$result) {
            //todo: exit_back();
        }
        
        $_SESSION['notifica'] = [
            'type' => 'success',
            'title' => 'Complimenti!',
            'text' => 'Cateogoria prodotto aggiornata correttamente'
        ];
        header('Location: ' . GESTIONE . 'gestione-categorie-prodotti.php');
        break;
        exit();
        
        break;
        exit();
        
    case 'elimina':
        if (empty($_POST['id_categoria'])) {
            $_SESSION['notifica'] = [
                'type' => 'error',
                'title' => 'Attenzione!',
                'text' => 'Impossibile trovare la categoria del prodotto'
            ];
            header('Location: ' . GESTIONE . 'gestione-categorie-prodotti.php');
            exit();
        }
        
        $query = "
            UPDATE
                categorie_prodotti
            SET
                attivo = 0
            WHERE
                id = '" . enc($_POST['id_categoria']) . "'";
        $result = esegui($query);
        
        if (!$result) {
            $_SESSION['notifica'] = [
                'type' => 'error',
                'title' => 'Attenzione!',
                'text' => 'Impossibile rimuovere la categoria del prodotto'
            ];
            header('Location: ' . GESTIONE . 'gestione-categorie-prodotti.php');
            exit();
        }
        
        $_SESSION['notifica'] = [
            'type' => 'success',
            'title' => 'Complimenti!',
            'text' => 'Categoria prodotto rimossa correttamente'
        ];
        header('Location: ' . GESTIONE . 'gestione-categorie-prodotti.php');
        exit();
        break;
}