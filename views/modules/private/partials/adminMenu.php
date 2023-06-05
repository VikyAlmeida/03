<?php
    $userController = new ControllerUsers();
    $establishmentController = new ControllerEstablishment();
    $categoryController = new ControllerCategory();
    $rolController = new ControllerRol();
    $sectionController = new ControllerSection();

    $users = $userController->ctrAllUser();
    $users_count = $userController->getUsers('SELECT role_id, count(role_id) as "usersByRole" FROM users group by role_id order by role_id');
    $users_json = json_encode($users_count);
    /*
        $users_count[0]['role_id'] admin
        $users_count[1]['role_id'] owner
        $users_count[2]['role_id'] visitor
    */ 

    $establishments = $establishmentController->ctrAllEstablishment();
    $categories = $categoryController->ctrAllCategories();
    $sections = $sectionController->ctrAllSections();
?>

<section class="categories-section spad">
	<!-- menu del administrador -->
	<div class="container" style="margin-top: 2em; margin-bottom:2em">
		<div class="row">
			<div class="col-12">
				<ul style=" list-style: none;display: flex; justify-content: space-between; text-align:center; padding:1em;">
					<li><a style="cursor:pointer; color: #4688C8;" onclick="getPartial('statistics')">Estadísticas</a></li>
					<li><a style="cursor:pointer; color: #4688C8;" onclick="getPartial('categories')">Categorias</a></li>
					<li><a style="cursor:pointer; color: #4688C8;" onclick="getPartial('users')">Usuarios</a></li>
					<li><a style="cursor:pointer; color: #4688C8;" onclick="getPartial('establishment')">Establecimientos</a></li>
					<li><a style="cursor:pointer; color: #4688C8;" onclick="getPartial('formats')">Diseño del inicio</a></li>
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
								<i class="fa fa-user-circle-o fa-3x" aria-hidden="true" style="margin:15px"></i>
								<div>
									<h2>Users</h2>
									<p>250 <i class="fa fa-user-circle-o" aria-hidden="true" ></i></p>
								</div>
							</div>
							<div class="card-stadistics">
								<i class="fa fa-user-circle-o fa-3x" aria-hidden="true" style="margin:15px"></i>
								<div>
									<h2>Users</h2>
									<p>250 <i class="fa fa-user-circle-o" aria-hidden="true" ></i></p>
								</div>
							</div>
							<div class="card-stadistics">
								<i class="fa fa-user-circle-o fa-3x" aria-hidden="true" style="margin:15px"></i>
								<div>
									<h2>Users</h2>
									<p>250 <i class="fa fa-user-circle-o" aria-hidden="true" ></i></p>
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
													<p style='color:#4688C8'>Establecimientos</p>
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
													<p style='color:#4688C8'>Members online</p>
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
			<div class="col-lg-12" id="users" style='display:none;'>		
				<div class="container">
					<div class="row">
						<div class="col-lg-12" style="margin-bottom: -5em;">
							<div class="section-title">
								<h2>Usuarios</h2>
								<p>Aquí se encuentra un listado de todos los usuarios registrados en la app.</p>
							</div>
						</div>
						<div class="col-lg-12">
							<table class="table table-striped-columns" id="tableAdminUsers">
								<thead>
									<tr>
										<th>Perfil</th>
										<th>DNI</th>
										<th>Nombre</th>
										<th>Usuario</th>
										<th>Email</th>
										<th>Rol</th>
										<th>Registro</th>
									</tr>
								</thead>
								<tbody>
									<?php
										if ($users):
											foreach ($users as $user):
												$rol = $rolController->ctrGetRol("id like ".$user["role_id"]);
												?>
													<tr>
														<td><img src="<?= $user["photo"] ?>" alt="" width="50"></td>
														<td><?= $user["dni"] ?></td>
														<td><?= $user["name"] ?></td>
														<td><?= $user["username"] ?></td>
														<td><?= $user["email"] ?></td>
														<td><?= $rol["name"] ?></td>
														<td><?= $user["created_at"] ?></td>
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
			<div class="col-lg-12" id="categories" style='display:none;'>
				<div class="container">
					<div class="row">
						<div class="col-lg-12"style="margin-bottom: -5em;">
							<div class="section-title">
								<h2>Categorias</h2>
								<p>Aquí se encuentra un listado de todas las categorias registrados en la app y podra crear, actualizar y eliminar la información.</p>
							</div>
						</div>
						<div class="col-lg-12">
							
				<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newCategory" style="margin-bottom: 1em;">
					<i class="fa fa-plus"></i> Crear nueva categoria
				</button>
				<div class="modal fade" id="newCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Crear nueva categoria</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body" style="background-color: #d82a4e;">
								<div>
									<form class="contact-form" action="" method="post" enctype="multipart/form-data">
										<input type="text" name="name" placeholder="Nombre">
										<textarea placeholder="Message" name="description"></textarea>
										<input type="file" name="photo" id="">
										<input type="hidden" name="id">
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
											background: #c2c2c2;" data-bs-dismiss="modal">Close</button>
											<?php
												if(isset($_POST)):
													if (isset($_POST["new"])):
														$categoryController->ctrInsertCategories($errores);
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
				<table class="table table-striped-columns" id="tableAdminCategories">
					<thead>
						<tr>
							<th>Foto</th>
							<th>Nombre</th>
							<th>Descripción</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						<?php
							if ($categories):
								foreach ($categories as $category):
									?>
										<tr>
											<td><img src="<?= $category["photo"] ?>" alt="" width="50"></td>
											<td><?= $category["name"] ?></td>
											<td><?= $category["description"] ?></td>
											<td>
												<div style="display:flex">
													<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit-category-<?=$category["id"]?>">
														<i class="fa fa-edit"></i>
													</button> 
													<form action="" method="post" style="margin-left:1em">
														<input type="hidden" name="id" value="<?=$category["id"]?>">
														<input type="hidden" name="delete">
														<button type="submit" class="btn btn-danger">
															<i class="fa fa-trash"></i>
														</button>
														<?php
															if(isset($_POST)):
																if (isset($_POST["delete"])):
																	$categoryController->ctrDeleteCategories();
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
			<div class="col-lg-12" id="establishment" style='display:none;'>
				<div class="container">
					<div class="row">
						<div class="col-lg-12"style="margin-bottom: -5em;">
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
	if ($categories):
		foreach ($categories as $category):
			?>
				<div class="modal fade" id="edit-category-<?=$category["id"]?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Editar categoria <?=$category["name"]?></h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body" style="background-color: #d82a4e;">
							<div>
								<form class="contact-form" action="" method="post" enctype="multipart/form-data">
									<input type="text" name="name" placeholder="Nombre" value="<?=$category["name"]?>">
									<textarea placeholder="Message" name="description"><?=$category["description"]?></textarea>
									<input type="file" name="photo" id="">
									<input type="hidden" name="id" value="<?=$category["id"]?>">
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
									<input type="hidden" name="update">
									<button type="button" style="display: inline-block;
										text-align: center;
										border: none;
										padding: 15px 10px;
										font-weight: 600;
										font-size: 16px;
										position: relative;
										color: #fff;
										cursor: pointer;
										background: #c2c2c2;" data-bs-dismiss="modal">Close</button>
										<?php
											if(isset($_POST)):
												if (isset($_POST["update"])):
													$categoryController->ctrUpdateCategories();
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