<div id="layoutSidenav_nav">
	<nav class="sidenav shadow-right sidenav-light">
		<div class="sidenav-menu">
			<div class="nav accordion" id="accordionSidenav">
				<!-- Sidenav Menu Heading (Tabelle)-->
				<div class="sidenav-menu-heading">Tabelle</div>
				<!-- Sidenav Tabs (Tabelle)-->
				<?php foreach($pagine as $p): ?>
					<?php if($p['subgroup_pagina'] == 0): ?>
						<a class="nav-link <?php if($_GET['route'] == $p['route_pagina']){ echo "active"; } ?>" href="index.php?route=<?php echo $p['route_pagina']; ?>">
							<div class="nav-link-icon"><i class="<?php echo $p['icona_intestazione_pagina']; ?>"></i></div>
							<?php echo $p['nome_intestazione_pagina']; ?>
						</a>
					<?php endif; ?>
				<?php endforeach; ?>

				<!-- Sidenav Menu Heading (Funzionalità)-->
				<div class="sidenav-menu-heading">Funzionalità</div>
				<!-- Sidenav Tabs (Funzionalità)-->
				<?php foreach($pagine as $p): ?>
					<?php if($p['subgroup_pagina'] == 1): ?>
						<a class="nav-link <?php if($_GET['route'] == $p['route_pagina'] && !isset($_GET['contenitore'])){ echo "active"; } ?>" href="index.php?route=<?php echo $p['route_pagina']; ?>">
							<div class="nav-link-icon"><i class="<?php echo $p['icona_intestazione_pagina']; ?>"></i></div>
							<?php echo $p['nome_intestazione_pagina']; ?>
						</a>
					<?php endif; ?>
				<?php endforeach; ?>

				<!-- Sidenav Menu Heading (Dati)-->
				<div class="sidenav-menu-heading">Dati</div>
				<!-- Sidenav Tabs (Dati)-->
				<?php foreach($pagine as $p): ?>
					<?php if($p['subgroup_pagina'] == 5): ?>
						<a class="nav-link <?php if($_GET['route'] == $p['route_pagina'] && !isset($_GET['contenitore'])){ echo "active"; } ?>" href="index.php?route=<?php echo $p['route_pagina']; ?>">
							<div class="nav-link-icon"><i class="<?php echo $p['icona_intestazione_pagina']; ?>"></i></div>
							<?php echo $p['nome_intestazione_pagina']; ?>
						</a>
					<?php endif; ?>
				<?php endforeach; ?>

				<?php if($_SESSION['login']['id_utente'] == 1 || $_SESSION['login']['id_utente'] == 24): ?> 
					<!-- Sidenav Menu Heading (Config)-->
					<div class="sidenav-menu-heading">Config</div>
					<!-- Sidenav Tabs (Config)-->
					<?php foreach($pagine as $p): ?>
						<?php if($p['subgroup_pagina'] == 2 && ($_SESSION['login']['id_utente'] == 1 || $_SESSION['login']['id_utente'] == 24)): ?>
							<a class="nav-link <?php if($_GET['route'] == $p['route_pagina']){ echo "active"; } ?>" href="index.php?route=<?php echo $p['route_pagina']; ?>">
								<div class="nav-link-icon"><i class="<?php echo $p['icona_intestazione_pagina']; ?>"></i></div>
								<?php echo $p['nome_intestazione_pagina']; ?>
							</a>
						<?php endif; ?>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>
		<!-- Sidenav Footer-->
		<div class="sidenav-footer">
			<div class="sidenav-footer-content">
				<div class="sidenav-footer-subtitle">
					Logged in as:
				</div>
				<div class="sidenav-footer-title">
					<?php echo $_SESSION['login']['nome_utente']." ".$_SESSION['login']['cognome_utente']; ?>
				</div>
			</div>
		</div>
	</nav>
</div>