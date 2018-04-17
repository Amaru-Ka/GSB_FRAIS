					<td>
						<div class="span7">
							  <div class="widget stacked widget-table action-table selectVisiteur">
								  <div class="widget-header">
									  <i class="icon-th-list"></i>
									  <h3>Selection d'un visiteur</h3>
								  </div>
								  <div class="widget-content">
									  <form action="index.php?uc=suiviPaiement&action=afficherFiche" method="post">
										  <table class="table table-striped table-bordered">
												  <tbody>
														<tr>
															<td>Visiteur : </td>
															<td>
																<select  name="choixVisiteur">
																<?php
																/**
																 * Boucle foreach afin d'afficher tous les visiteur qui ont fais une fiche
																*/
																	foreach ($IdVisiteur as $value) {
																		$echoEcran = "<option value='";
																		$echoEcran .= $value['idVisiteur'];
																		$echoEcran .= "'>";
																		$echoEcran .= $value['nom'];
																		$echoEcran .= "</option>";
																		echo $echoEcran;
																	}
																?>
																</select>
															</td>
															<td><button type="submit" name="valider" value="Ajouter" class="btn btn-block btn-success">Valider</button></td>
														</tr>
													</tbody>
											</table>
										</form>
									</div> <!-- /widget-content -->
								</div> <!-- /widget -->
							</div>
						</td>
					</tbody>
				</table>
			</form>
		</div>
	</div>
</div>
