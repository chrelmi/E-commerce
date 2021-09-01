<?php

$columns = require GESTIONE_PATH . 'ricerca/utenti/columns.php';

?>
    
<script type="text/javascript">
	window.columns = <?= json_encode($columns); ?>
</script>

<div id="box-ricerca" class="box-ricerca" style="<?= isset($_GET['ricerca']) ? '' : 'display: none' ?>">
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

<div class="row">
	<div class="col-12">
		<table id="tabella-utenti" class="w-100 datatable-search" data-idform="ricerca-utenti">
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
	</div>
</div>
