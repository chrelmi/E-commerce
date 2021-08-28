<?php

require_once dirname(__DIR__) . '/inc/config.php';
require_once ROOT_PATH . '_class/query.php';

?>

<!doctype html>
<html lang="en">
	<head>
    	<?php
    	include_once GESTIONE_PATH . 'inc/head.php';
    	?>
		<title>Hello, world!</title>
	</head>
	<body>
		<?php
		include_once GESTIONE_PATH . 'inc/testata.php';
		?>
		
		<h1>Hello, world!</h1>
		
		<?php
		include_once GESTIONE_PATH . 'inc/script.php';
		?>
	</body>
</html>