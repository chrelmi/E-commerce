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
        
        if (empty($_POST['descrizione']) || empty($_POST['codice'])) {
            //todo: exit_back();
        }

        if (!empty(checkUniqueColoreProdotto($_POST['descrizione']))) {
            
        }
        
        $query = "
            INSERT INTO
                colori_prodotti
            SET
                descrizione = '" . enc($_POST['descrizione']) . "',
                codice = '" . enc($_POST['codice']) . "',
                attivo = 1
        ";
        $result = esegui($query);
        if (!$result) {
            exit();
        }
        
        $_SESSION['notifica'] = [
            'type' => 'success',
            'title' => 'Complimenti!',
            'text' => 'colore prodotto creato correttamente'
        ];
        header('Location: ' . GESTIONE . 'gestione-colori-prodotti.php');
        break;
        exit();
        
    case 'modifica':
        if (empty($_POST['descrizione']) || empty($_POST['id_colore']) || empty($_POST['codice'])) {
            //todo: exit_back();
        }
        
        if (!empty(checkUniquecoloreProdotto($_POST['descrizione'], $_POST['id_colore']))) {
            
        }
        
        $query = "
            UPDATE
                colori_prodotti
            SET
                descrizione = '" . enc($_POST['descrizione']) . "',
                codice = '" . enc($_POST['codice']) . "'
            WHERE
                id = '" . enc($_POST['id_colore']) . "'
        ";
        $result = esegui($query);
        
        if (!$result) {
            exit();
        }
        
        $_SESSION['notifica'] = [
            'type' => 'success',
            'title' => 'Complimenti!',
            'text' => 'colore prodotto aggiornato correttamente'
        ];
        header('Location: ' . GESTIONE . 'gestione-colori-prodotti.php');
        break;
        exit();
        
    case 'elimina':
        if (empty($_POST['id_colore'])) {
            $_SESSION['notifica'] = [
                'type' => 'error',
                'title' => 'Attenzione!',
                'text' => 'Impossibile trovare la colore del prodotto'
            ];
            header('Location: ' . GESTIONE . 'gestione-colori-prodotti.php');
            exit();
        }
        
        $query = "
            UPDATE
                colori_prodotti
            SET
                attivo = 0
            WHERE
                id = '" . enc($_POST['id_colore']) . "'";
        $result = esegui($query);
        
        if (!$result) {
            $_SESSION['notifica'] = [
                'type' => 'error',
                'title' => 'Attenzione!',
                'text' => 'Impossibile rimuovere il colore del prodotto'
            ];
            header('Location: ' . GESTIONE . 'gestione-colori-prodotti.php');
            exit();
        }
        
        $_SESSION['notifica'] = [
            'type' => 'success',
            'title' => 'Complimenti!',
            'text' => 'Categoria colore rimosso correttamente'
        ];
        header('Location: ' . GESTIONE . 'gestione-colori-prodotti.php');
        exit();
        break;
}