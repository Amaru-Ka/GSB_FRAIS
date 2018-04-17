							<td>
								<div class="span7 col-md-12 col-lg-12 col-sm-12 content">
									<form method="POST"  action="index.php?uc=gererFrais&action=validerCreationFrais">
										<div class="widget stacked widget-table action-table">
											<div class="widget-header">
												<i class="icon-th-list"></i>
												<h3>Nouvel élément hors forfait</h3>
											</div>
											<div class="widget-content">
												<table class="table table-striped table-bordered">
													<thead>
														<tr>
															&nbsp;
														</tr>
													</thead>
													<tbody>
															<tr>
															   <td class="libelle">Date</td>
															   <td>
																   <input type="text" id="txtDateHF" name="dateFrais" size="10" maxlength="10" value="" placeholder="jj/mm/aaaa"  />
															   </td>
															</tr>
															<tr>
															   <th class="libelle">Libellé</th>
															   <th><input type="text" id="txtLibelleHF" name="libelle" size="20" maxlength="255" value="" /></th>
															</tr>
															<tr>
															   <th class="montant">Montant</th>
															   <th class="action"><input type="text" id="txtMontantHF" name="montant" size="10" maxlength="10" value="" /></th>
															</tr>

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
						</tr>
					</tbody>
				</table>
			</div> <!-- /widget-content -->
		</div> <!-- /widget -->
	</div>
</div>
