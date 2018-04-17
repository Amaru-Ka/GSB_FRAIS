										<div class="span7">
									  		  <div class="widget stacked widget-table action-table selectVisiteur">
									  			  <div class="widget-content">
									  				  <table class="table table-striped table-bordered">
										  					  <tbody>
										  						<tr>
																	<form action="index.php?uc=validerFrais&action=selectionnerVisiteur" method="post">
																	<td>Selection d'un mois :</td>
																	<td>
																		<select  name="choixMois">
																			<?php
																				foreach ($lesMois as $leMois) {
																					$echoEcran = "<option value='";
																					$echoEcran .= $leMois['mois'];
																					$echoEcran .= "'>";
																					$echoEcran .= $leMois['numMois']."/".$leMois['numAnnee'];
																					$echoEcran .= "</option>";
																					echo $echoEcran;
																				}
																			?>
																		</select>
																	</td>
																	<td><button type="submit" name="valider" value="Ajouter" class="btn btn-block btn-success">Valider</button></td>
																	</form>
																</tr>
																</tbody>
														</table>
													</div> <!-- /widget-content -->
												</div> <!-- /widget -->
										</div>
