<?php session_start();
	if (isset($_SESSION['usuario'])) {
		header('location: index.php');
	} 
	$errores = '';
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$usuario = filter_var(strtolower($_POST['user']), FILTER_SANITIZE_EMAIL);
		$password = $_POST['password'];
		$password = hash('sha512', $password);

		try {
			$conexion = new PDO('mysql:host=localhost;dbname=prueba_login', 'root', '');
		} catch (PDOException $e) {
			die();
		}

		$statement = $conexion->prepare(
			'SELECT * FROM usuarios WHERE  correo = :user AND password = :password'
		);
		$statement->execute(array(
			':user' => $usuario,
			':password' => $password
		));
		$resultado = $statement->fetch();
		var_dump($resultado);

		if ($resultado != false) {
			$_SESSION['usuario'] = $usuario;
			header('location: index.php');
		} else {
			$errores .= '<li> Datos incorrectos </li>';
		}
	}
	require 'views/login.view.php';
?>