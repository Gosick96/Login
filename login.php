<?php session_start();
	// COMPRUEBA SI HAY UNA SESIÓN ↓↓↓
	if (isset($_SESSION['usuario'])) {
		header('location: index.php');
	} 
	$errores = '';
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		// CAPTURA DE DATOS DEL FORMULARIO ↓↓↓
		$usuario = filter_var(strtolower($_POST['user']), FILTER_SANITIZE_EMAIL);
		$password = $_POST['password'];
		$password = hash('sha512', $password);

		// CONEXION CON LA BASE DE DATOS ↓↓↓
		try {
			$conexion = new PDO('mysql:host=localhost;dbname=prueba_login', 'root', '');
		} catch (PDOException $e) {
			die();
		}

		// CONSULTA A LA BASE DE DATOS COMPARANDO LOS CAMPOS DE USUARIO Y CONTRASEÑA CON LA BASE DE DATOS ↓↓↓
		$statement = $conexion->prepare(
			'SELECT * FROM usuarios WHERE  correo = :user AND password = :password'
		);
		$statement->execute(array(
			':user' => $usuario,
			':password' => $password
		));
		$resultado = $statement->fetch();
		var_dump($resultado);

		// SI LOS CAMPOS NO SON IGUALES ↓↓↓
		if ($resultado != false) {
			$_SESSION['usuario'] = $usuario;
			header('location: index.php');
		} else {
			$errores .= '<li> Datos incorrectos </li>';
		}
	}
	require 'views/login.view.php';
?>