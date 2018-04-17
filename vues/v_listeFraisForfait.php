<div id="toutLesTableaux">
<div class=" row tableauxSaisie">
	<div class="span7 col-lg-12 col-md-12 col-sm-12">
			<div class="widget stacked widget-table action-table">
				<div class="widget-header">
					<i class="icon-th-list"></i>
					<h3>Renseigner ma fiche de frais du mois <?php echo $nomMois."-".$numAnnee ?></h3>
				</div> <!-- /widget-header -->
					<div class="widget-content">
						<table class="table table-striped table-bordered">
							<tbody>
								<tr>
									<td>
										<div class="span7 col-md-12 col-lg-12 col-sm-12 content">
											<form method="POST"  action="index.php?uc=gererFrais&action=validerMajFraisForfait">
												<div class="widget stacked widget-table action-table">
													<div class="widget-header">
														<i class="icon-th-list"></i>
														<h3>Elements forfaitisés</h3>
													</div> <!-- /widget-header -->
														<div class="widget-content">
															<table class="table table-striped table-bordered">
																<thead>

																</thead>
																<tbody>
																	<?php
																		foreach ($lesFraisForfait as $unFrais){
																			$idFrais = $unFrais['idfrais'];
																			$libelle = $unFrais['libelle'];
																			$quantite = $unFrais['quantite'];
																			$retourEcran = "<tr><td>";
																			$retourEcran .= $libelle ;
																			$retourEcran .= "</td><td><input type='number' id='idFrais' name='";
																			$retourEcran .= "lesFrais[".$idFrais."]'";
																			$retourEcran .= "value='".$quantite."'></td></tr>";
																			echo $retourEcran;
																		}
																	?>
																</tbody>
																<thead>
																	<tr>
																		<th>
																			<button type="reset" class="btn btn-block btn-primary">Réinitialiser</button>
																		</th>
																		<th>
																			<button class="btn btn-block btn-success" type="submit" name="valider">Valider</button>
																		</th>
																	</tr>
																	</thead>
															</table>
														</div> <!-- /widget-content -->
												</div> <!-- /widget -->
											</form>
										</div>
									</td>
