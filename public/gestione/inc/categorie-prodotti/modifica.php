<?php

$categorieProdotti = getCategorieProdotti();

?>

<form method="post" action="<?= ROOT ?>_class/categorie-prodotti.php">
	<input type="hidden" name="azione" value="modifica" />
	<input type="hidden" name="id_categoria" value="<?= $categoriaModifica['id'] ?>" />
	
	<div class="row mb-3">
		<div class="col-12 col-md-4">
			<div class="form-group">
				<label>Categoria padre *</label>
				<select name="id_padre" class="form-select">
					<option value="">Nessuna</option>
					<?php
					foreach ($categorieProdotti as $categoriaProdotto) {
					    $selected = $categoriaModifica['id_padre'] == $categoriaProdotto['id'] ? "selected" : "";
					    if ($categoriaProdotto['id'] == $categoriaModifica['id']) {
					        continue;
					    }
					?>
					<option value="<?= $categoriaProdotto['id'] ?>" <?= $selected ?>>
						<?= $categoriaProdotto['descrizione'] ?>
					</option>
					<?php
					}
					?>
				</select>
			</div>
		</div>
		
		<div class="col-12 col-md-8">
			<div class="form-group">
				<label>Titolo categoria *</label>
				<input type="text" name="descrizione" class="form-control" required value="<?= $categoriaModifica['descrizione'] ?? '' ?>" />
			</div>
		</div>
	</div>
	
	<hr />
	
	<h5>Seo</h5>
	
	<div class="row mb-3">
    	<div class="col-12 col-md-3">
    		<div class="form-group">
    			<label>Permalink *</label>
    			<input type="text" name="slug" class="form-control" required value="<?= $categoriaModifica['slug'] ?? '' ?>" />
    		</div>
    	</div>
    	
    	<div class="col-12 col-md-3">
    		<div class="form-group">
    			<label>Title</label>
    			<input type="text" name="title" class="form-control" value="<?= $categoriaModifica['title'] ?? '' ?>" />
    		</div>
    	</div>
    	
    	<div class="col-12 col-md-3">
    		<div class="form-group">
    			<label>Description</label>
    			<input type="text" name="description" class="form-control" value="<?= $categoriaModifica['description'] ?? '' ?>" />
    		</div>
    	</div>
    	
    	<div class="col-12 col-md-3">
    		<div class="form-group">
    			<label>Keywords</label>
    			<input type="text" name="keywords" class="form-control" value="<?= $categoriaModifica['keywords'] ?? '' ?>" />
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