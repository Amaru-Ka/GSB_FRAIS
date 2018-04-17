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
														<th>
															Justificatif fourni : <?php echo $nbJustificatifs ?>
														</th>
														<tr>
										                   <th>Date</th>
										   					<th>Libellé</th>
										   					<th>Etat</th>
										                   <th>Montant</th>
										                   <th>&nbsp;</th>
										                </tr>
												</thead>
												<form class="" action="index.php?uc=validerFrais&action=fraisValide" method="post">
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
															if ($etat == "RF")
																$etat = "REFUSE";
															else {
																$etat = '';
															}
															$retourEcran = "<tr><td>".$date."</td>";
															$retourEcran .= "<td>".$libelle."</td>";
															$retourEcran .= "<td>".$etat."</td>";
															$retourEcran .= "<td>".$montant."</td>";
															$retourEcran .= "<td><a style='margin-right:2px' href='index.php?uc=validerFrais&action=refuserFraisHorsForfait&idFrais=".$id;
															$retourEcran .= "onclick='return var choix=confirm('Voulez-vous vraiment refuser ce frais?');' class='btn btn-sm btn-info' >";
															$retourEcran .= "Refuser ce frais</a>";
															$retourEcran .= "<a href='index.php?uc=validerFrais&action=refuserFraisHorsForfait&idFrais=".$id;
															$retourEcran .= "&reporterFrais=true' class='btn btn-sm btn-info' onclick='retrun alert('Ce frais a été reporté au mois suivant');'>";
															$retourEcran .= "Reporter ce frais</a></td></tr>";
															echo $retourEcran;
														  }
													?>
												</tr>
												<thead>
													<td></td>
													<td></td>
													<td></td>
													<td>
														<th>
															<button class="btn btn-block btn-success" type="submit" name="valider" onclick="alert('Les frais forfaitisés ont été actualisés')">Valider</button>
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
	function validerSaisie(){
		var choix = confirm('Voulez-vous vraiment valider cette fiche de frais?');
		if (choix == true)
			alert('La fiche de frais a été validé');
	}
</script>
