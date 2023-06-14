<?php
    $categoryController = new ControllerCategory();
    $establishmentController = new ControllerEstablishment();
    $userController = new ControllerUsers();

    $establishments = $establishmentController->ctrAllEstablishment();
	$categories = $categoryController->ctrAllCategories();
	$users = $userController->ctrAllUser();

    $establishments_json = json_encode($establishments);
    $categories_json = json_encode($categories);
    $users_json = json_encode($users);
?>
	
	
	<script>
		let page = localStorage.getItem('page') || 1;
		const categoryFilter  = localStorage.getItem('categoryFilter') || null;
		const nameFilter  = localStorage.getItem('nameFilter') || null;
		//pagina en la que estoy
		const pageSize = 3;
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
		
		const pages = Math.ceil(elements.length/pageSize); // paginas que necesito
		let init = (page-1)*pageSize;
		let finish = init + pageSize; 
		function next(page) {
			page = parseInt(localStorage.getItem('page')) || 1;
			if (Math.ceil(elements.length/pageSize)<= parseInt(localStorage.getItem('page'))) return 0;
			localStorage.setItem('page', page+1);
			location.reload();
		}
		function before(page) {
			page = localStorage.getItem('page')-1;
			if (page <= 0) return 0;
			localStorage.setItem('page', page);
			location.reload();
		}
		function pageNum(page) {
			localStorage.setItem('page', page);
			location.reload();
		}
		function obtenerNombreMes (numero) {
			let miFecha = new Date();
			if (0 < numero && numero <= 12) {
				miFecha.setMonth(numero - 1);
				return new Intl.DateTimeFormat('es-ES', { month: 'long'}).format(miFecha);
			} else {
				return null;
			}
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
			location.reload();
		}
	</script>
	
	
	<!-- Page info -->
	<div class="page-info-section set-bg" data-setbg="./views/style1/img/page-bg/4.jpg">
			<div class="container">
				<div class="site-breadcrumb">
					<a href="home">Home</a>
					<span>Establecimientos</span>
				</div>
			</div>
		</div>
	<!-- Page info end -->

	<!-- search section -->
	<section class="search-section ss-other-page">
		<div class="container">
			<div class="search-warp">
				<div class="section-title text-white">
					<h2><span>Search your course</span></h2>
				</div>
				<div class="row">
					<div class="col-lg-10 offset-lg-1">
						<!-- search form -->
						<form class="course-search-form" id="search">
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
							<a onclick="eliminarFiltros(); location.reload();" style="color:white">Eliminar Filtros</a>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- search section end -->


	<!-- Page  -->
	<section class="blog-page spad pb-0">
		<div class="container">
			<div class="row">
				<div class="col-lg-9">
					<!-- blog post -->
					<script>
						for (var i = init; i < finish; i++) {
							if (elements[i]){
								const d = new Date(elements[i].created_at);
								const date = `${d.getDate()} de ${obtenerNombreMes(d.getMonth()+1)} del ${d.getFullYear()}`;
								const foundOwner = users.find(element => element[0] === elements[i].owner);
								const foundCategory = categories.find(element => element[0] === elements[i].category_id);
								document.write(`<div class="blog-post">`)
								document.write(`	<img src="${elements[i].logo}" alt="" height="250">`)
								document.write(`	<h3>${elements[i].name}</h3>`)
								document.write(`	<div class="blog-metas">`)
								document.write(`		<div class="blog-meta author">`)
								document.write(`			<div class="post-author set-bg" data-setbg="img/authors/1.jpg"></div>`)
								document.write(`			<a href="#">${foundOwner.name}</a>`)
								document.write(`		</div>`)
								document.write(`		<div class="blog-meta">`)
								document.write(`			<a href="#">${foundCategory.name}</a>`)
								document.write(`		</div>`)
								document.write(`		<div class="blog-meta">`)
								document.write(`			<a href="#">${date}</a>`)
								document.write(`		</div>`)
								document.write(`	</div>`)
								document.write(`	<p>${elements[i].AboutUs}</p>`)
								document.write(`	<a href="establishment?${elements[i].id}" class="site-btn readmore">Read More</a>`)
								document.write(`</div>`)
							}
						}
					</script>
				<nav class="roberto-pagination fadeInUp mb-100" data-wow-delay="1000ms" >
					<ul class="pagination">
						<li class="page-item"><a class="page-link" onclick="before(page)"><i class="fa fa-angle-left"></i> Atras</a></li>
						<script>
							for (var i = 1; i <= pages; i++) {
								document.write(`<li class="page-item"><a class="page-link" onclick='pageNum(${i})'>${i}</a></li>`);
							}
						</script>
						<li class="page-item"><a class="page-link" onclick="next(page)">Siguiente <i class="fa fa-angle-right"></i></a></li>
					</ul>
				</nav>
				</div>
			</div>
		</div>
	<!-- course section end -->