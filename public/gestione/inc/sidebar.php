<div id="layoutSidenav_nav">
	<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <a class="nav-link <?= $pagina == "dashboard" ? 'active' : '' ?>" href="<?= GESTIONE ?>">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                
                <a class="nav-link <?= $pagina == "categorie-prodotti" ? 'active' : '' ?>" href="<?= GESTIONE ?>gestione-categorie-prodotti.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-tags"></i></div>
                    Categorie prodotti
                </a>
                
                <a class="nav-link <?= $pagina == "taglie-prodotti" ? 'active' : '' ?>" href="<?= GESTIONE ?>gestione-taglie-prodotti.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-tshirt"></i></div>
                    Taglie prodotti
                </a>
                
                <a class="nav-link <?= $pagina == "colori-prodotti" ? 'active' : '' ?>" href="<?= GESTIONE ?>gestione-colori-prodotti.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-tint"></i></div>
                    Colori prodotti
                </a>

                <a class="nav-link <?= $pagina == "dashboard" ? 'active' : '' ?>" href="<?= GESTIONE ?>gestione-colori-prodotti.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-box-open"></i></div>
                    Prodotti
                </a>
                
                <a class="nav-link <?= $pagina != "utenti" ? 'collapsed' : '' ?>" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon">
                    	<i class="fas fa-user-lock"></i>
                    </div>
                    Amministrazione
                    <div class="sb-sidenav-collapse-arrow">
                    	<i class="fas fa-angle-down"></i>
                	</div>
                </a>
                <div class="collapse <?= $pagina == "utenti" ? 'show' : '' ?>" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link <?= $pagina == "utenti" ? 'active' : '' ?>" href="<?= GESTIONE ?>gestione-utenti.php">
                        	<div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                    		Utenti
                        </a>
                    </nav>
                </div>
            </div>
        </div>
        
        <div class="sb-sidenav-footer">
            <div class="small">Benvenuto</div>
            <?= $utente['cognome'] . " " . $utente['nome'] ?>
        </div>
    </nav>
</div>