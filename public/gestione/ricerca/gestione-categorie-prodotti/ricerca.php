<?php

include_once dirname(__DIR__, 3) . '/inc/config.php';
include_once ROOT_PATH . '_class/query.php';
include_once ROOT_PATH . '_class/session.php';

if (!checkLoginGestione()) {
    header('Location: ' . GESTIONE);
    exit();
}

$columns = require GESTIONE_PATH . 'ricerca/gestione-categorie-prodotti/columns.php';

$where = [
    'c.attivo = 1',
];

if (!empty($_POST['data']['ricerca_titolo'])) {
    $where[] = "c.titolo LIKE '%" . enc($_POST['data']['ricerca_titolo']) . "%'";
}

$_SESSION['categorie_prodotti']['ricerca_titolo'] = $_POST['data']['ricerca_titolo'];

$order = [];
foreach ($_POST['order'] ?? [] as $ordinamento) {
    if (!isset($columns[$ordinamento['column']])) {
        continue;
    }
    
    $column = $columns[$ordinamento['column']];
    $tipoOrdinamento = $ordinamento['dir'] == 'asc' ? "ASC" : "DESC";
    
    switch ($column['data']) {
        case 'categoria_padre':
            $order[] = "cp.descrizione " . $tipoOrdinamento;
            break;

        case 'categoria':
            $order[] = "c.descrizione " . $tipoOrdinamento;
            break;
            
        default:
            $order[] = "c." . $column['data'] . " " . $tipoOrdinamento;
            break;
    }
}

$order[] = "c.id_padre ASC, c.descrizione ASC";

$start = (int) $_POST['start'] ?? 0;
$start = $start >= 0 ? $start : 0;

$length = (int) $_POST['length'] ?? 0;
$length = $length > 0 ? $length : 25;

$query = "
    SELECT SQL_CALC_FOUND_ROWS
        c.*,
        cp.descrizione AS categoria_padre
    FROM
        categorie_prodotti AS c
    LEFT JOIN categorie_prodotti AS cp ON cp.id = c.id_padre
    WHERE
        " . implode(" AND ", $where) . "
    ORDER BY " . implode(", ", $order) . "
    LIMIT " . $start . ", " . $length . ";
";
$categorie = select($query);
$rows = selectFirst("SELECT FOUND_ROWS() AS righe");

$items = [];

foreach ($categorie as $categoria) {
    $linkModifica = GESTIONE . 'gestione-categorie-prodotti.php?' . http_build_query([
        'modifica' => $categoria['id']
    ]);
    $linkRimuovi = ROOT . '_class/categorie-prodotti.php';
    $dataAggiornamento = DateTime::createFromFormat('Y-m-d H:i:s', $categoria['data_aggiornamento']);
    
    $items[] = [
        'categoria' => $categoria['descrizione'],
        'categoria_padre' => $categoria['categoria_padre'] ?? '',
        'slug' => $categoria['slug'],
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
                <input type="hidden" name="id_categoria" value="{$categoria['id']}" />
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
