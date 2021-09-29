<form method="post" action="<?= ROOT ?>_class/colori-prodotti.php">
	<input type="hidden" name="azione" value="nuovo" />
	
	<div class="row mb-3">
		
		<div class="col-12 col-md-4">
			<div class="form-group">
				<label>Colore *</label>
				<input type="text" name="descrizione" class="form-control" required />
			</div>
		</div>
		
		<div class="col-12 col-md-3 text-center">
			<div class="form-group">
				<label class="d-block" for="codice_colore">Seleziona colore *</label>
				<input type="color" id="codice_colore" name="codice" value="#ffffff" required />
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-12">
			<div class="btn-group">
				<button type="submit" class="btn btn-outline-success">Salva</button>
				<a href="<?= GESTIONE ?>gestione-categorie-prodotti.php" class="btn btn-outline-secondary">Indietro</a>
			</div>
		</div>
	</div>
</form>