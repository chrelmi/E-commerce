<?php

require_once dirname(__DIR__) . '/inc/config.php';
require_once ROOT_PATH . '_class/query.php';
require_once ROOT_PATH . '_class/session.php';

if (!checkLoginGestione()) {
    header('Location: ' . GESTIONE . 'login.php');
    exit();
}

$utente = getUtente();

$titoloPagina = "Gestione colori prodotti";

if (isset($_GET['modifica'])) {
    $coloreModifica = getColoreById($_GET['modifica']);
    if (empty($coloreModifica)) {
        $_SESSION['notifica'] = [
            'type' => 'error',
            'title' => 'Attenzione',
            'text' => 'Colore non trovata!'
        ];
        header('Location: ' . GESTIONE . 'gestione-colori-prodotti.php');
        exit();
    }
}

?>

<!doctype html>
<html lang="it">
	<head>
    	<?php
    	include_once GESTIONE_PATH . 'inc/head.php';
    	?>
		<title>GESTIONE COLORI PRODOTTI</title>
	</head>
	<body class="sb-nav-fixed">
		<?php
		include_once GESTIONE_PATH . 'inc/testata.php';
		?>
		<div id="layoutSidenav">
			<?php
			$pagina = "colori-prodotti";
    		include_once GESTIONE_PATH . 'inc/sidebar.php';
            ?>
            
            <div id="layoutSidenav_content">
                <main>
                	<div class="container-fluid p-4">
    		
    		<?php
    		if (isset($_GET['nuovo'])) {
    		    include_once GESTIONE_PATH . 'inc/colori-prodotti/nuovo.php';
    		} elseif (isset($_GET['modifica'])) {
    		    include_once GESTIONE_PATH . 'inc/colori-prodotti/modifica.php';
    		} else {
    		    include_once GESTIONE_PATH . 'inc/colori-prodotti/cerca.php';
    		}
    		?>
    				</div>
    			</main>
			</div>
		</div>
		<?php
		include_once GESTIONE_PATH . 'inc/script.php';
		?>
	</body>
</html>