					<tr>
						<br />
					</tr>
					<tr>
						<div class="span7">
						  <div class="widget stacked widget-table action-table listeMois">
							  <div class="widget-header">
								  <i class="icon-th-list"></i>
								  <h3>Fiche de frais du mois <?php echo $nomMois."-".$numAnnee?> :</h3>
							  </div>
							  <div class="widget-content">
								  <table class="table table-striped table-bordered">
									  <thead>
											  <th>Etat : <?php echo $libEtat?> depuis le <?php echo $dateModif?></th><th>Montant validé : <?php echo $montantValide?></th>
									  </thead>
								  </table>
							</div> <!-- /widget-content -->
						</div> <!-- /widget -->
					</div>
					</tr>
					<tr>
						<div class="span7">
						  <div class="widget stacked widget-table action-table listeMois">
							  <div class="widget-header">
								  <i class="icon-th-list"></i>
								  <h3>Eléments forfaitisés</h3>
							  </div>
							  <div class="widget-content">
								  <table class="table table-striped table-bordered">
										<tr>
										 <?php
										 foreach ( $lesFraisForfait as $unFraisForfait )
										{
										   $libelle = $unFraisForfait['libelle'];
									   ?>
										   <th> <?php echo $libelle?></th>
										<?php
										}
									   ?>
									   </tr>
										<tr>
										<?php
										  foreach (  $lesFraisForfait as $unFraisForfait  )
										 {
											   $quantite = $unFraisForfait['quantite'];
									   ?>
												<td class="qteForfait"><?php echo $quantite?> </td>
										<?php
										  }
									   ?>
									   </tr>
								  </table>
							</div> <!-- /widget-content -->
						</div> <!-- /widget -->
					</div>
					</tr>
					<tr>
						<div class="span7">
						  <div class="widget stacked widget-table action-table listeMois">
							  <div class="widget-header">
								  <i class="icon-th-list"></i>
								  <h3>Descriptif des éléments hors forfait -<?php echo $nbJustificatifs ?> justificatifs reçus -</h3>
							  </div>
							  <div class="widget-content">
								  <table class="table table-striped table-bordered">
					         <tr>
					            <th>Date</th>
					            <th>Libellé</th>
					            <th>Montant</th>
					         </tr>
						        <?php
						          foreach ( $lesFraisHorsForfait as $unFraisHorsForfait )
								  {
									$date = $unFraisHorsForfait['date'];
									$libelle = $unFraisHorsForfait['libelle'];
									$montant = $unFraisHorsForfait['montant'];
								?>
						             <tr>
						                <td><?php echo $date ?></td>
						                <td><?php echo $libelle ?></td>
						                <td><?php echo $montant ?></td>
						             </tr>
						        <?php
						          }
								?>
							    </table>
							</div> <!-- /widget-content -->
						</div> <!-- /widget -->
					</div>
					</tr>
				</tbody>
			</table>
		</div> <!-- /widget-content -->
	</div> <!-- /widget -->
</div>
