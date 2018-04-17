	    <div class="span7">
	  		  <div class="widget stacked widget-table action-table selectVisiteur">
	  			  <div class="widget-header">
	  				  <i class="icon-th-list"></i>
	  				  <h3>Valider les fiche de frais</h3>
	  			  </div>
	  			  <div class="widget-content">
	  				  <table class="table table-striped table-bordered">
		  					  <tbody>
		  							<tr>
										<form action="index.php?uc=validerFrais&action=selectionnerVisiteur" method="post">
										<td>Selection du visiteur : </td>
		  								<td>
											<select  name="choixVisiteur">
											<?php
											/**
											 * Boucle foreach afin d'afficher tous les visiteur qui ont fais une fiche
											*/
												foreach ($liste as $tuple) {
													$echoEcran = "<option value='";
													$echoEcran .= $tuple['idVisiteur'];
													$echoEcran .= "'>";
													$echoEcran .= $tuple['nom'];
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
