<?php include('partials/head.php') ?>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic" data-tilt>
					<img src="./views/style2/images/img-01.png" alt="IMG">
				</div>

				<form class="login100-form validate-form" method="post">
					<span class="login100-form-title">
						Login
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="password" placeholder="Contraseña">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					<div>
					
					</div>
					<div class="container-login100-form-btn">
						
							<?php
                                $users = new ControllerUsers();
                                $errors = $users->ctrLogin();
                                include('./views/modules/partials/errors_ul.php');
                            ?>
						<button class="login100-form-btn">
							Login
						</button>
					</div>

					<div class="text-center p-t-12">
						<span class="txt1">
							¿Olvidaste
						</span>
						<a class="txt2" href="forgotPassword">
							la contraseña?
						</a>
					</div>

					<div class="text-center p-t-136">
						<a class="txt2" href="register">
							Crear una cuenta
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	

	<?php include('partials/footer.php') ?>
</body>
</html>