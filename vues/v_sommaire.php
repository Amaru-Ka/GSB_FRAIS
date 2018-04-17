	<div class="row menu">
		<div id='menu'class="col-md-3 col-lg-3">
			<nav class="menu" id="cssmenu">
		        <ul>
		            <li class="active">
						<?php
							$lesMenus = $_SESSION['lesMenus'];
							$retourEcran = "<a>".$_SESSION['libelleService'];
							$retourEcran .= ": ".$_SESSION['prenom'];
							$retourEcran .= "  ".$_SESSION['nom']."</a>";
							echo  $retourEcran;
						?>
					</li>
					<?php
						foreach ($lesMenus as  $leMenu) {
							$retourEcran = "<li class='has-sub'>";
							$retourEcran .= "<a href='";
							$retourEcran .= $leMenu['lien'];
							$retourEcran .= "'>".$leMenu['titre'];
							$retourEcran .= "</a></li>";
							echo $retourEcran;
						}
					 ?>
					<li class="has-sub">
		              <a href="index.php?uc=connexion&action=deconnexion" title="Se déconnecter">Déconnexion</a>
		            </li>
		        </ul>
	        </nav>
		</div>
	</div>
