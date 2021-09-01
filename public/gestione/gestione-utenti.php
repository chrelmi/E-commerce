<?php

require_once dirname(__DIR__) . '/inc/config.php';
require_once ROOT_PATH . '_class/query.php';
require_once ROOT_PATH . '_class/session.php';

if (!checkLoginGestione()) {
    header('Location: ' . GESTIONE . 'login.php');
    exit();
}

$utente = getUtente();

$titoloPagina = "Gestione utenti";

?>

<!doctype html>
<html lang="en">
	<head>
    	<?php
    	include_once GESTIONE_PATH . 'inc/head.php';
    	?>
		<title>Hello, world!</title>
	</head>
	<body class="sb-nav-fixed">
		<?php
		include_once GESTIONE_PATH . 'inc/testata.php';
		?>
		<div id="layoutSidenav">
			<?php
    		include_once GESTIONE_PATH . 'inc/sidebar.php';
            ?>
            
            <div id="layoutSidenav_content">
                <main>
                	<div class="container-fluid px-4">
    		
    		<?php
    		if (isset($_GET['nuovo'])) {
    		    include_once GESTIONE_PATH . 'inc/utenti/nuovo.php';
    		} elseif (isset($_GET['modifica'])) {
    		    include_once GESTIONE_PATH . 'inc/utenti/modifica.php';
    		} else {
    		    include_once GESTIONE_PATH . 'inc/utenti/cerca.php';
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