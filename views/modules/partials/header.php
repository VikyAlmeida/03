
<script>
	const Message = (message) => {
		console.log(message);
		document.getElementById('btn-logout').innerHTML = message;
	};
</script>

<?php
	if (isset($_GET["route"]) and $_GET["route"]=="menu") $color = "blue";
	else $color = "white";
?>
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
								<nav class="main-menu" >
									<ul>
										<li><a style="color:<?=$color?>" href="home">Home</a></li>
										<li><a style="color:<?=$color?>" href="establishments">Establecimientos</a></li>
										<?php
											if (isset($_SESSION["user"]) && $_SESSION["user"]['role_id'] === 1):
												?>
												<li><a style="color:<?=$color?>" href="preview">Vista previa</a></li>
												<?php
											endif;
										?>
									</ul>
								</nav>
							</div>
							<div class="col-lg-4" style="text-align:right;">
								<?php
									if (isset($_SESSION["user"])):
										?>
											<div class="btn-group">
												<button type="button" style="background-color: transparent;border:0px; color:white" data-toggle="dropdown">
													<p style="color:<?=$color?>">
														<img src="<?=$_SESSION["user"]["photo"]?>" alt="" style="width: 60px; height: 60px; border-radius: 100%; margin-right: 10px;"/>
														<?=$_SESSION["user"]["username"]?>
													</p>
												</button>
												<div class="dropdown-menu">
													<a class="dropdown-item" href="home">Home</a>
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