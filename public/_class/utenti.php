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
        
        if (empty($_POST['id_ruolo']) || empty($_POST['cognome']) || empty($_POST['nome']) || 
            empty($_POST['email']) || empty($_POST['password'])
        ) {
            //todo: exit_back();
        }
        
        if (!empty(checkUniqueEmailUtente($_POST['email']))) {
            $_SESSION['notifica'] = [
                'type' => 'error',
                'title' => 'Attenzione!',
                'text' => 'Indirizzo email già registrato!'
            ];
            header('Location: ' . GESTIONE . 'gestione-utenti.php');
            exit();
        }
        
        $query = "
            INSERT INTO
                utenti
            SET
                id_ruolo = '" . enc($_POST['id_ruolo']) . "',
                cognome = '" . enc($_POST['cognome']) . "',
                nome = '" . enc($_POST['nome']) . "',
                email = '" . enc($_POST['email']) . "',
                password = '" . enc(md5($_POST['password'])) . "',
                attivo = 1";
        $result = esegui($query);
        
        if (!$result) {
            //todo: exit_back();
        }
        
        $_SESSION['notifica'] = [
            'type' => 'success',
            'title' => 'Complimenti!',
            'text' => 'Utente creato correttamente'
        ];
        header('Location: ' . GESTIONE . 'gestione-utenti.php');
        exit();
        break;
        
    case 'modifica':
        if (empty($_POST['id_ruolo']) || empty($_POST['cognome']) || empty($_POST['nome']) ||
            empty($_POST['email']) || empty($_POST['id_utente'])
        ) {
            //todo: exit_back();
        }
        
        if (!empty(checkUniqueEmailUtente($_POST['email'], $_POST['id_utente']))) {
            $_SESSION['notifica'] = [
                'type' => 'error',
                'title' => 'Attenzione!',
                'text' => 'Indirizzo email già registrato!'
            ];
            header('Location: ' . GESTIONE . 'gestione-utenti.php');
            exit();
        }
        
        $query = "
            UPDATE
                utenti
            SET
                id_ruolo = '" . enc($_POST['id_ruolo']) . "',
                cognome = '" . enc($_POST['cognome']) . "',
                nome = '" . enc($_POST['nome']) . "',
                email = '" . enc($_POST['email']) . "'";
        
        if (!empty($_POST['password'])) {
            $query .= ", password = '" . enc(md5($_POST['password'])) . "'";
        }
        
        $query .= " WHERE id = '" . enc($_POST['id_utente']) . "'";
        
        $result = esegui($query);
        
        if (!$result) {
            //todo: exit_back();
        }
        
        $_SESSION['notifica'] = [
            'type' => 'success',
            'title' => 'Complimenti!',
            'text' => 'Utente aggiornato correttamente'
        ];
        header('Location: ' . GESTIONE . 'gestione-utenti.php');
        exit();
        break;
        
    case 'elimina':
        
        if (empty($_POST['id_utente'])) {
            $_SESSION['notifica'] = [
                'type' => 'error',
                'title' => 'Attenzione!',
                'text' => 'Impossibile trovare l\'utente'
            ];
            header('Location: ' . GESTIONE . 'gestione-utenti.php');
            exit();
        }
        
        $query = "
            UPDATE
                utenti
            SET
                attivo = 0
            WHERE
                id = '" . enc($_POST['id_utente']) . "'";
        $result = esegui($query);
        
        if (!$result) {
            $_SESSION['notifica'] = [
                'type' => 'error',
                'title' => 'Attenzione!',
                'text' => 'Impossibile rimuovere l\'utente'
            ];
            header('Location: ' . GESTIONE . 'gestione-utenti.php');
            exit();
        }
        
        $_SESSION['notifica'] = [
            'type' => 'success',
            'title' => 'Complimenti!',
            'text' => 'Utente rimosso correttamente'
        ];
        header('Location: ' . GESTIONE . 'gestione-utenti.php');
        exit();
        break;
}