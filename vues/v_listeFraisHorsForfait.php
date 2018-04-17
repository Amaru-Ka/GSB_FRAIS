	<div class="row tableauAffichage content">
		<div class="span7 col-md-12 col-lg-12">
			<form method="POST"  action="index.php?uc=gererFrais&action=validerMajFraisForfait">
				<div class="widget stacked widget-table action-table">
					<div class="widget-header">
						<i class="icon-th-list"></i>
						<h3>Descriptif des éléments hors forfait</h3>
					</div>
					<div class="widget-content">
						<table class="table table-striped table-bordered">
							<thead>
									<tr>
									   <th class="date">Date</th>
									   <th class="libelle">Libellé</th>
									   <th class="montant">Montant</th>
									   <th class="action">&nbsp;</th>
									</tr>
							</thead>
							<tbody>
								<?php
									foreach( $lesFraisHorsForfait as $unFraisHorsForfait){
										$libelle = $unFraisHorsForfait['libelle'];
										$date = $unFraisHorsForfait['date'];
										$montant=$unFraisHorsForfait['montant'];
										$id = $unFraisHorsForfait['id'];

										$retourEcran = "<tr><td>".$date."</td>";
										$retourEcran .= "<td>".$libelle."</td>";
										$retourEcran .= "<td>".$montant."</td>";
										$retourEcran .= "<td><a href='index.php?uc=gererFrais&action=supprimerFrais&idFrais= ";
										$retourEcran .= $id ;
										$retourEcran .= "' class='btn btn-sm btn-info' onclick='return confirm('Voulez-vous vraiment supprimer ce frais?');'>";
										$retourEcran .= "<span class='glyphicon glyphicon-remove'></span>Supprimer ce frais</a></td>";
										echo $retourEcran;
									}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
</div>
