<?php

include_once dirname(__DIR__, 3) . '/inc/config.php';
include_once ROOT_PATH . '_class/query.php';
include_once ROOT_PATH . '_class/session.php';

if (!checkLoginGestione()) {
    header('Location: ' . GESTIONE);
    exit();
}

$columns = require GESTIONE_PATH . 'ricerca/gestione-colori-prodotti/columns.php';

$where = [
    'attivo = 1',
];

if (!empty($_POST['data']['ricerca_titolo'])) {
    $where[] = "c.titolo LIKE '%" . enc($_POST['data']['ricerca_titolo']) . "%'";
}

$_SESSION['colori_prodotti']['ricerca_titolo'] = $_POST['data']['ricerca_titolo'];

$order = [];
foreach ($_POST['order'] ?? [] as $ordinamento) {
    if (!isset($columns[$ordinamento['column']])) {
        continue;
    }
    
    $column = $columns[$ordinamento['column']];
    $tipoOrdinamento = $ordinamento['dir'] == 'asc' ? "ASC" : "DESC";
    
    switch ($column['data']) {
            
        default:
            $order[] = $column['data'] . " " . $tipoOrdinamento;
            break;
    }
}

$order[] = "descrizione ASC";

$start = (int) $_POST['start'] ?? 0;
$start = $start >= 0 ? $start : 0;

$length = (int) $_POST['length'] ?? 0;
$length = $length > 0 ? $length : 25;

$query = "
    SELECT SQL_CALC_FOUND_ROWS
        *
    FROM
        colori_prodotti
    WHERE
        " . implode(" AND ", $where) . "
    ORDER BY " . implode(", ", $order) . "
    LIMIT " . $start . ", " . $length . ";
";
$colori = select($query);
$rows = selectFirst("SELECT FOUND_ROWS() AS righe");

$items = [];

foreach ($colori as $colore) {
    $linkModifica = GESTIONE . 'gestione-colori-prodotti.php?' . http_build_query([
        'modifica' => $colore['id']
    ]);
    $linkRimuovi = ROOT . '_class/colori-prodotti.php';
    $dataAggiornamento = DateTime::createFromFormat('Y-m-d H:i:s', $colore['data_aggiornamento']);
    
    $items[] = [
        'colore' => $colore['descrizione'],
        'codice' => <<<HTML
            <div class="color-view" style="background-color: {$colore['codice']}"></div>
        HTML,
        'data_aggiornamento' => <<<HTML
            <div class="text-center">
            {$dataAggiornamento->format('d/m/Y H:i')}
            </div>
        HTML,
        'azioni' => <<<HTML
        <div class="text-center">
            <a class="btn btn-sm btn-outline-warning" href="{$linkModifica}" title="Modifica">
                <i class="fas fa-edit"></i> Modifica
            </a>
            <form method="post" action="{$linkRimuovi}" class="d-inline">
                <input type="hidden" name="azione" value="elimina" />
                <input type="hidden" name="id_colore" value="{$colore['id']}" />
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
