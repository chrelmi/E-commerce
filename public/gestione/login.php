<?php

require_once dirname(__DIR__) . '/inc/config.php';
require_once ROOT_PATH . '_class/query.php';
require_once ROOT_PATH . '_class/session.php';

if (checkLoginGestione()) {
    header('Location: ' . GESTIONE);
    exit();
}

if (isset($_POST['email']) && isset($_POST['password'])) {
    $query = "
        SELECT
            *
        FROM
            utenti
        WHERE
            attivo = 1
        AND
            email = '" . enc($_POST['email']) . "'
        AND
            password = '" . enc(md5($_POST['password'])) . "'
    ";
    $result = selectFirst($query);
    
    if (!empty($result)) {
        $_SESSION['user'] = $result;
        header('Location: ' . GESTIONE);
        exit();
    }
}

?>

<!doctype html>
<html lang="en">
	<head>
		<title>LOG IN</title>
    	<?php
    	include_once GESTIONE_PATH . 'inc/head.php';
    	?>
    	<link rel="stylesheet" href="<?= GESTIONE ?>css/login.css">
	</head>
	<body class="body-login">
		
		<div class="container p-5 d-flex flex-column align-items-center">
		
			<div class="box d-flex flex-column align-items-center">
				<img src="<?= IMG ?>logo.png" class="w-50" />
				<h1 class="text-center">ACCEDI</h1>
				<form method="post" action="<?= GESTIONE ?>login.php">
					<div class="form-group">
						<input type="email" name="email" placeholder="Email" />
					</div>
					
					<div class="form-group">
						<input type="password" name="password" placeholder="Password" />
					</div>
					
					<div class="form-group">
						<button type="submit" class="w-100 btn btn-outline-primary">
							ACCEDI
						</button>
					</div>
				</form>
			</div>
		
		</div>
		<?php
		include_once GESTIONE_PATH . 'inc/script.php';
		?>
	</body>
</html>