<?php

$ruoliUtenti = getRuoliUtenti();

?>

<form method="post" action="<?= ROOT ?>_class/utenti.php">
	<input type="hidden" name="azione" value="modifica" />
	<input type="hidden" name="id_utente" value="<?= $utenteModifica['id'] ?>" />
	
	<div class="row mb-3">
		<div class="col-12 col-md-6">
			<label>Ruolo *</label>
			<select name="id_ruolo" class="form-select" required>
				<option value="">Seleziona un ruolo</option>
				<?php
				foreach ($ruoliUtenti as $ruolo) {
				    $selected = $ruolo['id'] == $utenteModifica['id_ruolo'] ? "selected" : "";
				?>
				<option value="<?= $ruolo['id'] ?>" <?= $selected ?>>
					<?= $ruolo['descrizione'] ?>
				</option>
				<?php
				}
				?>
			</select>
		</div>
	</div>
	
	<div class="row mb-3">
		<div class="col-12 col-md-3">
			<label>Cognome *</label>
			<input type="text" name="cognome" class="form-control" required value="<?= $utenteModifica['cognome'] ?? '' ?>" />
		</div>
		
		<div class="col-12 col-md-3">
			<label>Nome *</label>
			<input type="text" name="nome" class="form-control" required value="<?= $utenteModifica['nome'] ?? '' ?>" />
		</div>
		
		<div class="col-12 col-md-3">
			<label>Email *</label>
			<input type="email" name="email" class="form-control" required value="<?= $utenteModifica['email'] ?? '' ?>" />
		</div>
		
		<div class="col-12 col-md-3">	
			<label>Password</label>
			<input type="text" name="password" class="form-control" />
		</div>
	</div>
	
	<div class="row">
		<div class="col-12">
			<div class="btn-group">
				<button type="submit" class="btn btn-outline-success">Salva</button>
				<a href="" class="btn btn-outline-secondary">Indietro</a>
			</div>
		</div>
	</div>
</form>