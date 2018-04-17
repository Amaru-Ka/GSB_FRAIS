<div class="span7 col-md-12 col-lg-12 col-sm-12 content">
		<div class="widget stacked widget-table action-table">
			<div class="widget-header">
				<i class="icon-th-list"></i>
				<h3>Valider les frais du mois <?php echo $nomMois."-".$numAnnee ?></h3>
			</div> <!-- /widget-header -->
				<div class="widget-content">
					<table class="table table-striped table-bordered">
						<tbody>
							<td>
								<div class="span7 col-md-12 col-lg-12 col-sm-12 content">
									<div class="widget stacked widget-table action-table">
										<div class="widget-header">
											<i class="icon-th-list"></i>
											<h3>Eléments forfaitisés</h3>
										</div> <!-- /widget-header -->
										<div class="widget-content">
											<table class="table table-striped table-bordered">
												<form method="POST"  action="index.php?uc=validerFrais&action=actualiserInfosFiche">
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
																<button class="btn btn-block btn-success" type="submit" name="valider" onclick="alert('Les frais forfaitisés ont été actualisés')">Valider</button>
															</th>
														</tr>
														</thead>
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
