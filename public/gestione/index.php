<?php

require_once dirname(__DIR__) . '/inc/config.php';
require_once ROOT_PATH . '_class/query.php';
require_once ROOT_PATH . '_class/session.php';

if (!checkLoginGestione()) {
    header('Location: ' . GESTIONE . 'login.php');
    exit();
}

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
		</div>
		<?php
		include_once GESTIONE_PATH . 'inc/script.php';
		?>
	</body>
</html>