<?php
    $userController = new ControllerUsers();
    $establishmentController = new ControllerEstablishment();
    $categoryController = new ControllerCategory();
    $rolController = new ControllerRol();
    $sectionController = new ControllerSection();

    $users = $userController->ctrAllUser();
    $establishments = $establishmentController->ctrGetEstablishmentByCondicion('SELECT * FROM establishments where owner = '.$_SESSION['user']['id']);
    $categories = $categoryController->ctrAllCategories();
    $sections = $sectionController->ctrAllSections();

	// estadisticas
		//cards
			$countEstablishments = count($establishments);
			$newUsers24h = $userController->getUsers('SELECT count(*) as  newsUsers FROM users where date_format(TIMEDIFF(now(), created_at),"%H") <= 24')[0];
			
		//graficas
			$usersByRole = $userController->getUsers('SELECT role_id, count(role_id) as "usersByRole" FROM users group by role_id');
			$sectionsByCategory = $categoryController->ctrGetCategoryByCondicion('');
			$establishmentForMonth = $establishmentController->ctrGetEstablishmentByCondicion('SELECT count(id) as establishemnByCreatedDate, month(created_at) as mes FROM establishments e group by (month(created_at)) Order by created_at');

			$users_json = json_encode($usersByRole);
			$establishment_json = json_encode($establishmentForMonth);

?>

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet"/>
<link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
	function configure(establishment) {
		localStorage.setItem('establishmentConfigure', establishment);
		location.href = 'previewEstablishment?'+establishment;
	}
</script>
<section class="categories-section spad">
	<!-- menu del administrador -->
	<div class="container" style="margin-top: 2em; margin-bottom:2em">
		<div class="row">
			<div class="col-12">
				<ul style=" list-style: none;display: flex; justify-content: space-between; text-align:center; padding:1em;">
					<li><a style="cursor:pointer; color: #4688C8;" onclick="getPartial('statistics')">Estadísticas</a></li>
					<li><a style="cursor:pointer; color: #4688C8;" onclick="getPartial('establishment')">Mis establecimientos</a></li>
				</ul>
			</div>
		</div>
	</div>
	<!-- apartados -->
	<div class="container">
		<div class="row">
			<div class="col-lg-12" id="statistics" style='display:none;'>
				<div class="container" >
					<div class="col-12">
						<div class="container" style="display:flex;justify-content: space-between;">
							<div class="card-stadistics">
								<i class="fa fa-shopping-basket fa-3x" aria-hidden="true" style="margin:15px"></i>
								<div>
									<h2>Locales</h2>
									<p><?= $countEstablishments ?> <i class="fa fa-shopping-cart" aria-hidden="true"></i></p>
								</div>
							</div>
							<div class="card-stadistics">
								<i class="fa fa-user-plus fa-3x" aria-hidden="true" style="margin:15px"></i>
								<div>
									<h2>Nuevos usuarios</h2>
									<p><?= $newUsers24h ?> <i class="fa fa-user-circle-o" aria-hidden="true" ></i></p>
								</div>
							</div>
							<div class="card-stadistics">
								<i class="fa fa-pencil-square-o fa-3x" aria-hidden="true" style="margin:15px"></i>
								<div>
									<h2>Actualizacion</h2>
									<p>250 <i class="fa fa-home" aria-hidden="true" ></i></p>
								</div>
							</div>
						</div>
					</div>
					<div class="col-12">
						<div class='container' style="padding:3em;margin:0 auto;">
							<div class="row">
								<div class="col-sm-6 col-lg-6">
									<div class="card text-white bg-flat-color-4">
										<div class="card-body pb-0">
											<div style='display:flex;width:100%;'>
												<div style="width:50%;">
													<h4 class="mb-0">
														<span class="count">1</span>
													</h4>
													<p style='color:#4688C8'>Usuarios</p>
												</div>
												<div style="width:50%;justify-content:center">
													<div id='container'>
														<canvas id="myChart1" style='margin-bottom:1em;'></canvas>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-6 col-lg-6" style='margin-bottom:1em;'>
									<div class="card text-white bg-flat-color-4">
										<div class="card-body pb-0">
											<div style='display:flex;width:100%;'>
												<div style="width:50%;">
													<h4 class="mb-0">
														<span class="count">2</span>
													</h4>
													<p style='color:#4688C8'>Categorias</p>
												</div>
												<div style="width:50%;justify-content:center">
													<div id='container'>
														<canvas id="myChart2" height='300'style='margin-bottom:1em;'></canvas>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-6 col-lg-12" >
									<div class="card text-white bg-flat-color-4"style="height: 300px;">
										<div class="card-body pb-0">
											<div style='display:flex;width:100%;'>
												<div style="width:50%;">
													<h4 class="mb-0">
														<span class="count">3</span>
													</h4>
													<p style='color:#4688C8'>Nuevos locales</p>
												</div>
												<div style="width:50%;justify-content:center">
													<div id='container'>
														<canvas id="myChart3" height='170'></canvas>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-12" id="establishment" style='display:none;'>
				<div class="container">
					<div class="row">
						<div class="col-lg-12"style="margin-bottom: -5em;">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newLocal" style="margin-bottom: 1em;">
					<i class="fa fa-plus"></i> Crear nuevo local
				</button>
				<div class="modal fade" id="newLocal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Crear nuevo local</h5>
							<button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body" style="background-color: #d82a4e;">
							<div>
								<form class="contact-form" action="" method="post" enctype="multipart/form-data">
									<input type="text" name="name" placeholder="Nombre">
									<input type="text" name="description" placeholder="Descripcion corta">
									<textarea placeholder="AboutUs" name="aboutUs">Descripcion larga</textarea>
									<input type="file" name="photo" id="" placeholder="Logo">
									<input type="text" name="tlf" id="" placeholder="Telefono">
									<input type="text" name="email" id="" placeholder="Email">
									<input type="text" name="web_site" id="" placeholder="Sitio web">
									<select name="category" id='category' class="input-form">
										<option value="0">Selecciona una categoria</option>												
										<?php
											if (isset($categories)):
												foreach($categories as $category):
												?>
														<option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>	
												<?php
												endforeach;
											endif;
										?>
									</select>
									<input type="hidden" name="new">
									<?php
										if (isset($sections)):
											foreach($sections as $section):
												?>
													<input type="checkbox" name="<?=$section["name"]?>" id="" value="<?=$section["name"]?>">
													<?=$section["name"]?>
												<?php
											endforeach;
										endif;
									?>
									<button type="submit" class="site-btn">Guardar</button>
									<button type="button" style="display: inline-block;
										text-align: center;
										border: none;
										padding: 15px 10px;
										font-weight: 600;
										font-size: 16px;
										position: relative;
										color: #fff;
										cursor: pointer;
										background: #c2c2c2;" data-dismiss="modal">Close</button>
										<?php
											if(isset($_POST)):
												if (isset($_POST["new"])):
													$errores = $establishmentController->ctrInsertEstablishment();
													include('./views/modules/partials/errors_ul.php');
												endif;
											endif;
										?>
								</form>
							</div>
						</div>
						</div>
						</div>
					</div>
				</div>
							<div class="section-title">
								<h2>Establecimientos</h2>
								<p>Aquí se encuentra un listado de todos los Establecimientos registrados en la app.</p>
							</div>
						</div>
						<div class="col-lg-12">
							<table class="table table-striped-columns" id="tableAdminEstablishments">
								<thead>
									<tr>
										<th>Logo</th>
										<th>Nombre</th>
										<th>Descripción</th>
										<th>Contacto</th>
										<th>Acciones</th>
									</tr>
								</thead>
								<tbody>
									<?php
										if ($establishments):
											foreach ($establishments as $establishment):
												?>
													<tr>
														<td><img src="<?= $establishment["logo"] ?>" alt="" width="50"></td>
														<td><?= $establishment["name"] ?></td>
														<td><?= $establishment["description"] ?></td>
														<td><?= $establishment["tlf"] ?></td>
														<td>
														<div style="display:flex">
															<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit-establishment-<?=$establishment["id"]?>">
																<i class="fa fa-edit"></i>
															</button> 
															<button type="button"  class="btn btn-info" style="margin-left:0.5em" onclick='configure(<?=$establishment["id"]?>)'>
																<i class="fa fa-cogs"></i>
															</button> 
															<form action="" method="post" style="margin-left:0.5em">
																<input type="hidden" name="id" value="<?=$establishment["id"]?>">
																<input type="hidden" name="delete">
																<button type="submit" class="btn btn-danger">
																	<i class="fa fa-trash"></i>
																</button>
																<?php
																	if(isset($_POST)):
																		if (isset($_POST["delete"])):
																			$establishmentController->ctrDeleteEstablishment();
																		endif;
																	endif;
																?>
															</form>
																</div>
														</td>
													</tr>
												<?php
											endforeach;
										endif;
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Modal -->
<?php
	if ($establishments):
		foreach ($establishments as $establishment):
			?>
				<div class="modal fade" id="edit-establishment-<?=$establishment["id"]?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Editar categoria <?=$establishment["name"]?></h5>
						</div>
						<div class="modal-body" style="background-color: #d82a4e;">
							<div>
								<form class="contact-form" action="" method="post" enctype="multipart/form-data">
									<input type="text" name="name" placeholder="Nombre" value="<?= $establishment['name'] ?>">
									<input type="text" name="description" placeholder="Descripcion corta" value="<?= $establishment['description'] ?>">
									<textarea placeholder="AboutUs" name="aboutUs"><?= $establishment['AboutUs'] ?></textarea>
									<input type="file" name="photo" id="" placeholder="Logo">
									<input type="text" name="tlf" id="" placeholder="Telefono"value="<?= $establishment['tlf'] ?>">
									<input type="text" name="email" id="" placeholder="Email" value="<?= $establishment['email'] ?>">
									<input type="text" name="web_site" id="" placeholder="Sitio web" value="<?= $establishment['web_site'] ?>">
									<!-- <select name="category" id='category' class="input-form">
										<option value="0">Selecciona una categoria</option>												
										<?php
											if (isset($categories)):
												foreach($categories as $category):
													if ($category['id'] === $establishment['category_id']): $selected = 'selected';
													else: $selected = '';
													endif;
													?>
														<option value="<?= $category['id'] ?>" <?= $selected ?>><?= $category['name'] ?></option>	
													<?php
												endforeach;
											endif;
										?>
									</select> -->
									<input type="hidden" name="update">
									<input type="hidden" name="fotoAntes" value="<?= $establishment['logo'] ?>">
									<input type="hidden" name="id" value="<?= $establishment['id'] ?>">
									<button type="submit" class="site-btn">Guardar</button>
									<button type="button" style="display: inline-block;
										text-align: center;
										border: none;
										padding: 15px 10px;
										font-weight: 600;
										font-size: 16px;
										position: relative;
										color: #fff;
										cursor: pointer;
										background: #c2c2c2;" data-dismiss="modal">Close</button>
										<?php
											if(isset($_POST)):
												if (isset($_POST["update"])):
													$errores = $establishmentController->ctrUpdateEstablishment();
													include('./views/modules/partials/errors_ul.php');
												endif;
											endif;
										?>
								</form>
							</div>
						</div>
					</div>
					</div>
				</div>
			</div>
			
			<?php
		endforeach;
	endif;
?>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>