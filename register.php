<?php session_start();

	// COMPRUEBA SI HAY UNA SESION INICIADA ↓↓↓
	if (isset($_SESSION['usuario'])) {
		header('location: index.php');
	} 
	// COMPRUEBA SI EL METODO DE ENVIO ES POST ↓↓↓
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		// GUARDANDO LOS DATOS DEL FORMULARIO EN VARIABLES ↓↓↓
		$name = filter_var(strtolower($_POST['name']), FILTER_SANITIZE_STRING);
		$lastname = filter_var(strtolower($_POST['apellido']), FILTER_SANITIZE_STRING);
		$mail = $_POST['mail'];
		$password = $_POST['pass1'];
		$password2 = $_POST['pass2'];

		$errores = '';

		// COMPRUEBA SI EL FORMULARIO TIENE LOS CAMPOS LLENOS ↓↓↓
		if(empty($name) or empty($lastname) or empty($mail) or empty($password) or empty($password2)) {
			$errores .= '<li>Ingrese todos los datos</li>';
		} else {
			// CONEXION A BASE DE DATOS ↓↓↓
			try {
				$conexion = new PDO('mysql:host=localhost;dbname=prueba_login', 'root', '');
			} catch (PDOException $e) {
				die();
			}
			// COMPARA EL VALOR DE INPUT CON LA BASE DE DATOS ↓↓↓
			$statement = $conexion->prepare('SELECT * FROM usuarios WHERE correo = :mail LIMIT 1');
			$statement->execute(array(
				':mail' => $mail
			));
			$resultado = $statement->fetch();

			if ($resultado != false) {
				$errores .= '<li> El correo ingresado ya existe </li>';				
			}

			// ENCRIPTANDO Y COMPARANDO CONTRASEÑAS LA BASE DE DATOS ↓↓↓
			$password = hash('sha512', $password);
			$password2 = hash('sha512', $password2);

			if ($password != $password2) {
				$errores .= '<li> Las contraseñas son diferentes </li>';
			}

			// COMPRUEBA QUE EL CORREO SEA VALIDO ↓↓↓
			if (!empty($mail)) {
				$mail = filter_var($mail, FILTER_SANITIZE_EMAIL);

				if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
					$errores .= '<li> correo invalido </li>';
				}
			} else {
				$errores .= '<li> Ingrese un correo </li>';
			}
		}
		// SI  NO HAY ERRORES SE INSERTAN LOS DATOS EN LA BASE DE DATOS ↓↓↓
		if ($errores == '') {
			$statement = $conexion->prepare('INSERT INTO usuarios (id, nombre, apellido, correo, password) VALUES (NULL, :name, :apellido, :mail, :pass1)');
			$statement->execute(array(
				':name' => $name,
				':apellido' => $lastname,
				':mail' => $mail,
				':pass1' => $password
			));

			header('location: login.php');
		}
	}
	require 'views/register.view.php';
?>