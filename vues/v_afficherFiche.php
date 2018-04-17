<div class="span7 col-md-12 col-lg-12 col-sm-12 content">
	<div class="widget stacked widget-table action-table">
		<div class="widget-header">
			<i class="icon-th-list"></i>
			<h3>Récapitulatif des frais</h3>
		</div> <!-- /widget-header -->
		<div class="widget-content">
			<table class="table table-striped table-bordered">
					<tbody>
						<td>
							<div class="span7 col-md-12 col-lg-12 col-sm-12 content">
								<div class="widget stacked widget-table action-table">
									<div class="widget-header">
										<i class="icon-th-list"></i>
										<h3>Récapitulatif des frais forfaitisés</h3>
									</div> <!-- /widget-header -->
									<div class="widget-content">
										<table class="table table-striped table-bordered">
												<tbody>
													<td>
														<?php
														foreach ( $lesFraisForfait as $unFraisForfait ){
														   $quantite = $unFraisForfait['quantite'];
														   $libelle = $unFraisForfait['libelle'];
														   $retourEcran = "<tr><td>".$libelle."</td>";
														   $retourEcran .= "<td>".$quantite."</td></tr>";
														   echo $retourEcran;
													   }
													   ?>
													</td>
											</tbody>
									</table>
								</div> <!-- /widget-content -->
							</div> <!-- /widget -->
							</div>
						</td>
						<td>
							<div class="span7 col-md-12 col-lg-12 col-sm-12 content">
								<div class="widget stacked widget-table action-table">
									<div class="widget-header">
										<i class="icon-th-list"></i>
										<h3>Descriptif des éléments hors forfait</h3>
									</div> <!-- /widget-header -->
									<div class="widget-content">
										<table class="table table-striped table-bordered">
												<thead>
														<tr>
															<th style="text-align:right">Justificatif fourni :<?php echo $nbJustificatifs ?></th>
														</tr>

														<tr>
										                   <th>Date</th>
										   					<th>Libellé</th>
										   					<th>Etat</th>
										                   <th>Montant</th>
										                </tr>
												</thead>
												<form action="index.php?uc=suiviPaiement&action=mettreEnPaiement" method="post">
												<tbody>
												<tr>
													<?php
														foreach( $lesFraisHorsForfait as $unFraisHorsForfait)
														{
															$libelle = $unFraisHorsForfait['libelle'];
															$date = $unFraisHorsForfait['date'];
															$mois = $unFraisHorsForfait['mois'];
															$montant=$unFraisHorsForfait['montant'];
															$id = $unFraisHorsForfait['id'];
															$etat = $unFraisHorsForfait['etatFraisHF'];
															switch ($etat) {
																case 'RF':
																	$etat = "REFUSÉ";
																	break;

																case 'VA':
																	$etat = "VALIDÉ";
																	break;

																case 'RB':
																	$etat = "REMBOURSÉ";
																	break;
																case '':
																	$etat = "NON RENSEIGNÉ";
																	break;
															}
															$retourEcran = "<tr><td>".$date."</td>";
															$retourEcran .= "<td>".$libelle."</td>";
															$retourEcran .= "<td>".$etat."</td>";
															$retourEcran .= "<td>".$montant."</td>";
															$retourEcran .= "</tr>";
															echo $retourEcran;
														  }
													?>
												</tr>
												<thead>
													<td></td>
													<td></td>
													<td>
														<th>
															<button class="btn btn-block btn-success" type="submit" name="valider" onclick="alert('La fiche a été mise à jour')">Mettre en paiement</button>
														</th>
													</td>
												</thead>
												</tbody>
											</form>
										</table>
									</div> <!-- /widget-content -->
								</div> <!-- /widget -->
							</div>
						</td>
					</tbody>
			</table>
		</div> <!-- /widget-content -->
	</div> <!-- /widget -->
</div>
</td>
</tbody>
</table>
</div> <!-- /widget-content -->
</div> <!-- /widget -->
</div>
<script type="text/javascript">
</script>
