
<script>
	const Message = (message) => {
		console.log(message);
		document.getElementById('btn-logout').innerHTML = message;
	};
</script>
<header class="header-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-3">
					<div class="site-logo">
						<a href="index"><img src="./views/style1/img/logo.png" alt="" width="75"></a>
					</div>
					<div class="nav-switch">
						<i class="fa fa-bars"></i>
					</div>
				</div>
				<div class="col-lg-9 col-md-9">
					<div class="container">
						<div class="row">
							<div class="col-lg-8">
								<nav class="main-menu">
									<ul>
										<li><a href="home">Home</a></li>
										<li><a href="#">About us</a></li>
										<li><a href="courses.html">Courses</a></li>
										<li><a href="blog.html">News</a></li>
									</ul>
								</nav>
							</div>
							<div class="col-lg-4">
								<?php
									if (isset($_SESSION["user"])):
										?>
											<div class="btn-group" style="margin:0 auto;">
												<button type="button" style="background-color: transparent;border:0px;" data-toggle="dropdown">
													<p>
														<img src="<?=$_SESSION["user"]["photo"]?>" alt="" style="width: 60px; height: 60px; border-radius: 100%; margin-right: 10px; margin-top: -1em; "/>
														<?=$_SESSION["user"]["username"]?>
													</p>
												</button>
												<div class="dropdown-menu">
													<a class="dropdown-item" href="home">Home</a>
													<a class="dropdown-item" href="#">Editar perfil</a>
													<a class="dropdown-item" href="menu">Menu</a>
													<div class="dropdown-divider"></div>
														<a class="dropdown-item" href="logout">Salir</a>
													</div>
												</div>
										<?php
									else:
										?>
											<a href="javascript:window.open('login','')" class="site-btn header-btn">Login</a>
										<?php
									endif;
								?>
							</div>
						</div>
					</div>
                   <!-- Example single danger button -->
				</div>
			</div>
		</div>
	</header>