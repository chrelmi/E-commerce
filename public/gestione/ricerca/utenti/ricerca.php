<?php

include_once dirname(__DIR__, 3) . '/inc/config.php';
include_once ROOT_PATH . '_class/query.php';
include_once ROOT_PATH . '_class/session.php';

if (!checkLoginGestione()) {
    header('Location: ' . GESTIONE);
    exit();
}

$columns = require GESTIONE_PATH . 'ricerca/utenti/columns.php';

$where = [
    'u.attivo = 1',
];

if (!empty($_POST['data']['ricerca_titolo'])) {
    $where[] = "c.titolo LIKE '%" . enc($_POST['data']['ricerca_titolo']) . "%'";
}

$_SESSION['corso']['ricerca_titolo'] = $_POST['data']['ricerca_titolo'];

$order = [];
foreach ($_POST['order'] ?? [] as $ordinamento) {
    if (!isset($columns[$ordinamento['column']])) {
        continue;
    }
    
    $column = $columns[$ordinamento['column']];
    $tipoOrdinamento = $ordinamento['dir'] == 'asc' ? "ASC" : "DESC";
    
    switch ($column['data']) {
        case 'categoria':
            $order[] = "cat.descrizione " . $tipoOrdinamento;
            break;
            
        default:
            $order[] = "u." . $column['data'] . " " . $tipoOrdinamento;
            break;
    }
}

$order[] = "u.cognome ASC";

$start = (int) $_POST['start'] ?? 0;
$start = $start >= 0 ? $start : 0;

$length = (int) $_POST['length'] ?? 0;
$length = $length > 0 ? $length : 25;

$query = "
    SELECT SQL_CALC_FOUND_ROWS
        u.*
    FROM
        utenti AS u
    WHERE
        " . implode(" AND ", $where) . "
    ORDER BY " . implode(", ", $order) . "
    LIMIT " . $start . ", " . $length . ";
";

$utenti = select($query);
$rows = selectFirst("SELECT FOUND_ROWS() AS righe");

$items = [];

foreach ($utenti as $utente) {
    
    $items[] = [
        'cognome' => $utente['cognome'],
        'nome' => $utente['nome'],
        'email' => $utente['email'],
        'azioni' => <<<HTML
        <div class="text-center">
        <a href="#" title="Vedi" target="_blank" class="btn btn-submit">
            <i class="fa fa-eye" aria-hidden="true"></i>
        </a>
        <a class="btn btn-plus" href="?clone={$utente['id']}" title="Clona">
            <i class="fal fa-clone"></i>
        </a>
        <a class="btn btn-edit" href="?edit={$utente['id']}" title="Modifica">
            <i class="fas fa-edit"></i>
        </a>
        <a class="btn btn-remove elimina-record" data-path="?delete={$utente['id']}" title="Elimina">
            <i class="fas fa-trash"></i>
        </a>
        </div>
        HTML,
        ];
}

header('Content-type: application/json');
echo json_encode([
    'draw' => $_POST['draw'] ?? 0,
    'data' => $items,
    'recordsTotal' => (int) $rows['righe'],
    'recordsFiltered' => (int) $rows['righe'],
]);
