<?php

$columns = require GESTIONE_PATH . 'ricerca/utenti/columns.php';

?>
    
<script type="text/javascript">
	window.columns = <?= json_encode($columns); ?>
</script>

<div class="btn-group mb-3">
	<button type="button" class="btn btn-sm btn-outline-warning">
		<i class="fas fa-search"></i> Apri/Chiudi ricerca
	</button>
	<a class="btn btn-sm btn-outline-success" href="<?= GESTIONE ?>gestione-utenti.php?<?= http_build_query([
	    'nuovo' => true
	]) ?>">
		<i class="fas fa-plus"></i> Nuovo utente
	</a>
	<button type="button" class="btn btn-sm btn-outline-primary reset-ordinamento">
		<i class="fas fa-eraser"></i> Rimuovi ordinamento
	</button>
</div>

<div id="box-ricerca" class="box-ricerca <?= isset($_GET['ricerca']) ? '' : 'd-none' ?>">
    <form action="<?= GESTIONE ?>ricerca/utenti/ricerca.php" method="POST" id="ricerca-utenti">
    	<input type="hidden" name="ricerca" value="1" />
        <div class="row">
        	<div class="col-12 col-md-3">
        		<label>Titolo del corso</label>
        		<input type="text" name="ricerca_titolo" class="u-full-width campo-ricerca" value="<?= $_SESSION['corso']['ricerca_titolo'] ?? '' ?>" />
        	</div>
    	</div>
        
        <div class="row">
        	<div class="col-12">
        		<button type="submit" class="btn btn-edit">
        			<i class="fal fa-search"></i> Cerca
    			</button>
        		<button type="button" class="btn btn-remove annulla-ricerca">
        			<i class="fal fa-sync-alt"></i> Annulla ricerca
    			</button>
        		<button type="button" class="btn btn-submit reset-ordinamento">
        			<i class="fal fa-eraser"></i> Rimuovi ordinamento
    			</button>
        	</div>
        </div>
    </form>
</div>

<table id="tabella-utenti" class="w-100 datatable-search table" data-idform="ricerca-utenti">
	<thead>
		<tr>
		<?php
		foreach ($columns as $column) {
		?>
		<th class="<?= $column['class'] ?>">
			<?= htmlspecialchars($column['titolo']) ?>
		</th>
		<?php
		}
		?>
		</tr>
	</thead>
	<tbody>
	</tbody>
</table>
