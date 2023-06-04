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
						Escribe el codigo
					</span>

					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="code" placeholder="Codigo">
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

                    <div class="wrap-input100 validate-input" data-validate = "Password is required">
                        <input class="input100" type="password" name="password2" placeholder="Repetir Contraseña">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
					<div>
					
					</div>
					<div class="container-login100-form-btn">
						
							<?php
                                $users = new ControllerUsers();
                                $errors = $users->forgotPassword();
                            ?>
						<button class="login100-form-btn">
							Recuperar
						</button>
					</div>

					<div class="text-center p-t-136">
						<a class="txt2" href="login">
							Iniciar sesión
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