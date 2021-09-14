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
        u.*,
        ur.descrizione AS ruolo
    FROM
        utenti AS u
    INNER JOIN utenti_ruoli AS ur ON ur.id = u.id_ruolo
    WHERE
        " . implode(" AND ", $where) . "
    ORDER BY " . implode(", ", $order) . "
    LIMIT " . $start . ", " . $length . ";
";

$utenti = select($query);
$rows = selectFirst("SELECT FOUND_ROWS() AS righe");

$items = [];

foreach ($utenti as $utente) {
    $linkModifica = GESTIONE . 'gestione-utenti.php?' . http_build_query([
        'modifica' => $utente['id']
    ]);
    $linkRimuovi = ROOT . '_class/utenti.php';
    
    $items[] = [
        'ruolo' => $utente['ruolo'],
        'cognome' => $utente['cognome'],
        'nome' => $utente['nome'],
        'email' => $utente['email'],
        'azioni' => <<<HTML
        <div class="text-center">
            <a class="btn btn-sm btn-outline-warning" href="{$linkModifica}" title="Modifica">
                <i class="fas fa-edit"></i> Modifica
            </a>
            <form method="post" action="{$linkRimuovi}" class="d-inline">
                <input type="hidden" name="azione" value="elimina" />
                <input type="hidden" name="id_utente" value="{$utente['id']}" />
                <button type="submit" class="btn btn-sm btn-outline-danger rimuovi-record" title="Elimina">
                    <i class="fas fa-trash"></i> Rimuovi
                </button>
            </form>
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
