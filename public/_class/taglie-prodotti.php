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
        
        if (!empty($_POST['descrizione'])) {
            //todo: exit_back();
        }

        if (!empty(checkUniqueTagliaProdotto($_POST['descrizione']))) {
            
        }
        
        $query = "
            INSERT INTO
                taglie_prodotti
            SET
                descrizione = '" . enc($_POST['descrizione']) . "',
                attivo = 1
        ";
        $result = esegui($query);
        if (!$result) {
            exit();
        }
        
        $_SESSION['notifica'] = [
            'type' => 'success',
            'title' => 'Complimenti!',
            'text' => 'Taglia prodotto creata correttamente'
        ];
        header('Location: ' . GESTIONE . 'gestione-taglie-prodotti.php');
        break;
        exit();
        
    case 'modifica':
        if (!empty($_POST['descrizione']) || empty($_POST['id_taglia'])) {
            //todo: exit_back();
        }
        
        if (!empty(checkUniqueTagliaProdotto($_POST['descrizione'], $_POST['id_taglia']))) {
            
        }
        
        $query = "
            UPDATE
                taglie_prodotti
            SET
                descrizione = '" . enc($_POST['descrizione']) . "'
            WHERE
                id = '" . enc($_POST['id_taglia']) . "'
        ";
        $result = esegui($query);
        if (!$result) {
            exit();
        }
        
        $_SESSION['notifica'] = [
            'type' => 'success',
            'title' => 'Complimenti!',
            'text' => 'Taglia prodotto aggiornata correttamente'
        ];
        header('Location: ' . GESTIONE . 'gestione-taglie-prodotti.php');
        break;
        exit();
        
    case 'elimina':
        if (empty($_POST['id_taglia'])) {
            $_SESSION['notifica'] = [
                'type' => 'error',
                'title' => 'Attenzione!',
                'text' => 'Impossibile trovare la taglia del prodotto'
            ];
            header('Location: ' . GESTIONE . 'gestione-taglie-prodotti.php');
            exit();
        }
        
        $query = "
            UPDATE
                taglie_prodotti
            SET
                attivo = 0
            WHERE
                id = '" . enc($_POST['id_taglia']) . "'";
        $result = esegui($query);
        
        if (!$result) {
            $_SESSION['notifica'] = [
                'type' => 'error',
                'title' => 'Attenzione!',
                'text' => 'Impossibile rimuovere la taglia del prodotto'
            ];
            header('Location: ' . GESTIONE . 'gestione-taglie-prodotti.php');
            exit();
        }
        
        $_SESSION['notifica'] = [
            'type' => 'success',
            'title' => 'Complimenti!',
            'text' => 'Categoria taglia rimossa correttamente'
        ];
        header('Location: ' . GESTIONE . 'gestione-taglie-prodotti.php');
        exit();
        break;
}