<!DOCTYPE html>
<html lang="en">
<head>
	<link href="https://fonts.googleapis.com/css?family=Acme" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<title>Registro</title>
	<div class="login">
		<div class="container">
			<div class="row">
				<div class="col d-flex justify-content-center">
					<form class="form" id="form" method="POST" name="login" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
						<h2 class="mb-3">Registrate</h2>
						<div class="align-items-center d-flex input-group mb-3">
							<label for="user"><i class="fas fa-user"></i></label>
							<input class="form-control" type="text" name="name" id="name" placeholder="Nombre">
						</div>
						<div class="align-items-center d-flex input-group mb-3">
							<label for="user"><i class="fas fa-user"></i></label>
							<input class="form-control" type="text" name="apellido" id="lastname" placeholder="Apellido">
						</div>
						<div class="align-items-center d-flex input-group mb-3">
							<label for="user"><i class="fas fa-envelope"></i></label>
							<input class="form-control" type="mail" name="mail" id="mail" placeholder="Correo">
						</div>
						<div class="align-items-center d-flex input-group mb-3">
							<label for="password"><i class="fas fa-key"></i></label>
							<input class="form-control" type="password" name="pass1" id="password" placeholder="Contraseña">
						</div>
						<div class="align-items-center d-flex input-group mb-3">
							<label for="password"><i class="fas fa-key"></i></label>
							<input class="form-control" type="password" name="pass2" id="password2" placeholder="Confirmar contraseña">
						</div>
						<button type="submit" class="submit">Registrarse</button>
						<?php if (!empty($errores)) : ?>
							<div class="row">
								<div class="col">
									<div class="errores">
										<ul>
											<?php echo $errores; ?>
										</ul>
									</div>
								</div>
							</div>
						<?php endif; ?>
					</form>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<p class="text_login">
						¿Ya tienes cuenta? <br>
						<a href="login.php">Iniciar Sesión</a>
					</p>
				</div>
			</div>
		</div>
	</div>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
</body>
</html>