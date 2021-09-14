<?php

$ruoliUtenti = getRuoliUtenti();

?>

<form method="post" action="<?= ROOT ?>_class/utenti.php">
	<input type="hidden" name="azione" value="nuovo" />
	
	<div class="row mb-3">
		<div class="col-12 col-md-6">
			<div class="form-group">
				<label>Ruolo *</label>
				<select name="id_ruolo" class="form-select" required>
					<option value="">Seleziona un ruolo</option>
					<?php
					foreach ($ruoliUtenti as $ruolo) {
					?>
					<option value="<?= $ruolo['id'] ?>"><?= $ruolo['descrizione'] ?></option>
					<?php
					}
					?>
				</select>
			</div>
		</div>
	</div>
	
	<div class="row mb-3">
		<div class="col-12 col-md-3">
				<label>Cognome *</label>
				<input type="text" name="cognome" class="form-control" required />
		</div>
		
		<div class="col-12 col-md-3">
			<div class="form-group">
				<label>Nome *</label>
				<input type="text" name="nome" class="form-control" required />
			</div>
		</div>
		
		<div class="col-12 col-md-3">
			<div class="form-group">
				<label>Email *</label>
				<input type="email" name="email" class="form-control" required />
			</div>
		</div>
		
		<div class="col-12 col-md-3">	
			<div class="form-group">
				<label>Password *</label>
				<input type="text" name="password" class="form-control" required />
			</div>
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