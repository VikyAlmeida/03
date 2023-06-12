<style>
	.div{
		background-color: rgb(255, 255, 255,0.6);
		text-align: center;
		padding: 2em;
		margin:0 auto;
	}
</style>

<?php
    $categoryController = new ControllerCategory();
    $establishmentController = new ControllerEstablishment();
    $userController = new ControllerUsers();

    $firstCategories = $categoryController->ctrGetCategoryByCondicion('SELECT * FROM inaya2.categories order by created_at asc limit 6');
	$categories = $categoryController->ctrAllCategories();
    $establishments = $establishmentController->ctrAllEstablishment();
	
    $establishments = $establishmentController->ctrAllEstablishment();
	$categories = $categoryController->ctrAllCategories();
	$users = $userController->ctrAllUser();

    $establishments_json = json_encode($establishments);
    $categories_json = json_encode($categories);
    $users_json = json_encode($users);
?>

<script>
		const categoryFilter  = localStorage.getItem('categoryFilter') || null;
		const nameFilter  = localStorage.getItem('nameFilter') || null;
		//pagina en la que estoy
		let elements = <?= $establishments_json ?>;
		const categories = <?= $categories_json ?>;
		const users = <?= $users_json ?>;
		if (nameFilter !== null && categoryFilter !== null) {
			elements = elements.filter(element => { 
				const cadena = element[1].toLowerCase();
				const subcadena = nameFilter.toLowerCase();
				if (cadena.includes(subcadena)) return element
			});
			
			elements = elements.filter(element => element.category_id == categoryFilter);
		}
		else if (nameFilter !== null) {
			elements = elements.filter(element => { 
				const cadena = element[1].toLowerCase();
				const subcadena = nameFilter.toLowerCase();
				if (cadena.includes(subcadena)) return element
			});
		}
		else if (categoryFilter !== null)  {
			elements = elements.filter(element => element.category_id == categoryFilter);
		}
		else {
			elements = elements
		}
		
		function eliminarFiltros() {
			localStorage.removeItem('nameFilter');
			localStorage.removeItem('categoryFilter');
		}
		function filterEstablishment() {
			eliminarFiltros();
			const categoryFilter  = document.getElementById('category').value;
			const nameFilter  = document.getElementById('name').value;
			if (categoryFilter !== '0') localStorage.setItem('categoryFilter', categoryFilter);
			if (nameFilter) localStorage.setItem('nameFilter', nameFilter);
			location.href = 'establishments';
		}
</script>
<section class="hero-section set-bg"  data-setbg="./views/style1/img/page-bg/4.jpg" style="background-image: url('./views/style1/img/page-bg/4.jpg');display: flex;align-items: center;">
    <div class="container" style="margin:0 auto;">
		<div class="div">
			<h1>Ayamonte</h1>
		</div>
    </div>
</section>


	<!-- categories section -->
	<section class="categories-section spad">
		<div class="container">
			<div class="section-title">
				<h2>Nuestras Categorias</h2>
				<p>Aqui podra encontrar las primeras 6 categorias.</p>
			</div>
			<div class="row">
				<!-- categorie -->
				<?php
					if (isset($firstCategories)):
						foreach($firstCategories as $category):
							$d = new DateTime($category['created_at']);
							setlocale(LC_ALL, 'spanish');
							$monthNum  = $d->format('m');
							$dateObj   = DateTime::createFromFormat('!m', $monthNum);
							$monthName = strftime('%B', $dateObj->getTimestamp());
							$fecha = $d->format('d').' de '.$monthName.' del '.$d->format('y');
						?>
							<div class="col-lg-4 col-md-6">
								<div class="categorie-item">
									<div class="ci-thumb set-bg" data-setbg="<?= $category['photo'] ?>"></div>
									<div class="ci-text">
										<h5><?= $category['name'] ?></h5>
										<p><?= $category['description'] ?></p>
										<span><?= $fecha ?></span>
									</div>
								</div>
							</div>
						<?php
						endforeach;
					endif;
				?>
			</div>
		</div>
	</section>
	<!-- categories section end -->


	<!-- search section -->
	<section class="search-section">
		<div class="container">
			<div class="search-warp">
				<div class="section-title text-white">
					<h2>Encuentra tu local</h2>
				</div>
				<div class="row">
					<div class="col-md-10 offset-md-1">
						<!-- search form -->
						<form class="course-search-form">
							<input type="text" name="name" id='name' placeholder="Encuentra por nombre">
							<select name="category" id='category' class="btn-form-styled">
								<option value="0">Encuentra por categoria</option>												
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
							<a class="site-btn btn-dark" onclick="filterEstablishment()" style="color:white">Buscar</a>
							<a onclick="eliminarFiltros(); location.reload();">Eliminar Filtros</a>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- search section end -->


	<!-- course section -->
	<section class="course-section spad">
		<div class="container">
			<div class="section-title mb-0">
				<h2>Locales</h2>
				<p>Aqui encontraras los establecimientos mas nuevos.</p>
			</div>
		</div>
		<div class="course-warp">
			<ul class="course-filter controls">
				<li class="control active" data-filter="all">All</li>
				<?php
					if (isset($firstCategories)):
						foreach($firstCategories as $category):
						?>
							<li class="control" data-filter=".<?=$category['name']?>"><?=$category['name']?></li>	
						<?php
						endforeach;
					endif;
				?>
			</ul>                                       
			<div class="row course-items-area">		
				<?php
					if (isset($establishments)):
						foreach($establishments as $establishment):
							$categoryByEstablishment = $categoryController->ctrGetCategories('id like '.$establishment['category_id']);
							$owner = $userController->ctrGetUser('id like '.$establishment['owner']);
							
							$d = new DateTime($establishment['created_at']);
							setlocale(LC_ALL, 'spanish');
							$monthNum  = $d->format('m');
							$dateObj   = DateTime::createFromFormat('!m', $monthNum);
							$monthName = strftime('%B', $dateObj->getTimestamp());
							$fecha = $d->format('d').' de '.$monthName.' del '.$d->format('y');
						?>
							<div class="mix col-lg-3 col-md-4 col-sm-6 <?= $categoryByEstablishment['name'] ?>" >
								<div class="course-item">
									<div class="course-thumb set-bg" data-setbg="<?= $establishment['logo'] ?>">
										<div class="price"><?= $categoryByEstablishment['name'] ?></div>
									</div>
									<div class="course-info" style="height: 22em;">
										<div class="course-text">
											<h5><?= $establishment['name'] ?></h5>
											<p><?= $establishment['description'] ?></p>
											<div class="students"><?= $fecha ?></div>
										</div>
										<div class="course-author">
											<div class="ca-pic set-bg" data-setbg="views/style1/img/authors/2.jpg"></div>
											<p><?= $owner['name'] ?>, <span>Developer</span></p>
										</div>
									</div>
								</div>
							</div>
						<?php
						endforeach;
					endif;
				?>
			</div>
		</div>
	</section>
	<!-- course section end -->

	<!-- banner section -->
	<section class="banner-section spad">
		<div class="container">
			<div class="section-title mb-0 pb-2">
				<h2>Bienvenido a la comunidad!</h2>
				<p>Aqui se encuentran los establecimientos de Ayamonte divididos por categorias, registrate y disfruta de las ventajas de ser propietario de un establecimiento.</p>
			</div>
			<div class="text-center pt-5">
				<a href="register" class="site-btn">Register Now</a>
			</div>
		</div>
	</section>