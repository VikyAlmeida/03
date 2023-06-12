<style>
	.div{
		background-color: rgb(255, 255, 255,0.6);
		text-align: center;
		padding: 2em;
		margin:0 auto;
	}
</style>

<?php
    $styleController = new ControllerStyle();
    $bannerImg = $styleController->mostrarHome(1);
    $bannerTxt = $styleController->mostrarHome(2);
    $registroTitle = $styleController->mostrarHome(3);
    $registroSubtitle = $styleController->mostrarHome(4);
    $registroBtn = $styleController->mostrarHome(5);
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

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet"/>
<link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<section class="hero-section set-bg"  data-setbg="./views/style1/img/page-bg/4.jpg" style="background-image: url(<?= $bannerImg['datum'] ?>);display: flex;align-items: center;">
    <div class="container" style="margin:0 auto;">
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#changeBanner" style="margin-bottom: 1em;">
				<i class="fa fa-plus"></i> Cambiar banner
			</button>
		<div class="div">
			<h1><?= $bannerTxt['datum'] ?></h1>
		</div>
    </div>
</section>

	<!-- banner section -->
	<section class="banner-section spad">
		<div class="container">
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#changeRegistro" style="margin-bottom: 1em;">
				<i class="fa fa-plus"></i> Cambiar registro
			</button>
			<div class="section-title mb-0 pb-2">
				<h2><?= $registroTitle['datum'] ?></h2>
				<p><?= $registroSubtitle['datum'] ?></p>
			</div>
			<div class="text-center pt-5">
				<a href="register" class="site-btn"><?= $registroBtn['datum'] ?></a>
			</div>
		</div>
	</section>
					  <!-- Modal -->
					  
				<div class="modal fade" id="changeBanner" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Cambiar banner</h5>
							<button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body" style="background-color: #d82a4e;">
								<div>
									<form class="contact-form" action="" method="post" enctype="multipart/form-data">
										<input type="text" name="name" placeholder="Nombre">
										<input type="file" name="banner_img" id="">
										<button type="submit" class="site-btn">Guardar</button>
										<input type="hidden" name="banner">
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
													if (isset($_POST["banner"])):
														$styleController->home('banner');
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
				
				<div class="modal fade" id="changeRegistro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Cambiar banner</h5>
							<button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body" style="background-color: #d82a4e;">
								<div>
									<form class="contact-form" action="" method="post" enctype="multipart/form-data">
										<input type="text" name="title" placeholder="Titulo">
										<input type="text" name="subtitle" placeholder="Subtitulo">
										<input type="hidden" name="registro">
										<input type="text" name="btn" placeholder="Texto del boton">
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
													if (isset($_POST["registro"])):
														$styleController->home('registro');
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









	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>