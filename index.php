<?php
require 'inc/header.php';
?>
<div class="container">

<!-- Outer Row -->
<div class="row justify-content-center">

    <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <!--Perro-->
                    <div class="col-lg-6 d-none d-lg-block bg-login-image">
                        <img class="img-fluid" src="img/undraw_profile_2.svg" alt="">
                    </div>
                      <!--FORMULARIO-->
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Plataforma WEB UCATEC</h1>
                                <h5>LOGIN DE USUARIO</h5>
                            </div>
                            <form class="user" action="login.html" method="POST">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user"
                                        id="nomUsuario" name="nomUsuario" aria-describedby="emailHelp"
                                        placeholder="Ingresar Usuario">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user"
                                        id="password" name="password" placeholder="Contraseña">
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox small">
                                        <input type="checkbox" class="custom-control-input" id="customCheck">
                                        <label class="custom-control-label" for="customCheck">Recuerdame
                                            </label>
                                    </div>
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary btn-user btn-block">
                                Iniciar Sesion
                                </button>
                                <hr>
                                <?php
    if (isset($_POST['submit'])) {
        // Obtener datos del formulario
        $nomUsuario = $_POST['nomUsuario'];
        $password = $_POST['password'];

        // Conectar a la base de datos
        $conn = mysqli_connect("localhost", "root", "", "db_portalweb");
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Preparar la sentencia SQL para prevenir inyecciones SQL
        $stmt = mysqli_prepare($conn, "SELECT * FROM usuario WHERE nomUsuario = ? AND password = ?");

        // Enlazar parámetros
        mysqli_stmt_bind_param($stmt, "ss", $nomUsuario, $password);

        // Ejecutar la sentencia
        mysqli_stmt_execute($stmt);

        // Obtener el resultado
        $result = mysqli_stmt_get_result($stmt);

        // Verificar si se encontró un usuario
        if ($row = mysqli_fetch_assoc($result)) {
            // Inicio de sesión exitoso
            // Aquí puedes iniciar una sesión, almacenar datos del usuario, etc.
            session_start();
            $_SESSION['usuario_id'] = $row['id']; // Suponiendo que tienes un campo id en tu tabla

            // Redirigir a la página de bienvenida o panel de control
            header('Location: dashboard.php');
            exit();
        } else {
            // Inicio de sesión fallido
            echo "Nombre de usuario o contraseña incorrectos.";
        }

        // Cerrar la sentencia y la conexión
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
    ?>
                            </form>
                         </div>


                           
                            <div class="text-center">
                                <a class="small" href="">¿Olvidaste tu contraseña?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="registro.php">Registrar Cuenta</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

</div>



<?php
require 'inc/footer.php';
?>