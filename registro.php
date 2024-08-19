<?php
require 'inc/header.php';
?>


<div class="container">

<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
            <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
            <div class="col-lg-7">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Registro de Usuario</h1>
                    </div>

                    <form class="user" method="POST">
                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user"  name="nombre" id="nombre"
                                    placeholder="Ingresar Nombre">
                            </div>
                            </div>
                            <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" name="apPaterno"  id="apPaterno"
                                    placeholder="Ingrese Apellido Paterno">
                            </div>
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" name="apMaterno" id="apMaterno"
                                    placeholder="Ingrese Apellido Materno">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" name="nomUsuario" id="nomUsuario"
                                placeholder="Nick de Usuario">
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="password" class="form-control form-control-user" name="password"
                                    id="password" placeholder="Contraseña">
                            </div>
                            <div class="col-sm-6">
                                <input type="password" class="form-control form-control-user"name="rpassword"
                                    id="rpassword" placeholder="Repetir Password">
                            </div>
                            </div>
                            <div class="col-sm-12 mb-0 mb-sm-3">
                                <input type="text" class="form-control form-control-user"
                                    name="ci" id="ci" placeholder="CI">
                            </div>
                        </div>
                        
                        <button type="submit" name="submit" class="btn btn-primary btn-user btn-block">
                             Registrar Cuenta
                        </button>
                        <!--
                        <hr>
                        <a href="index.html" class="btn btn-google btn-user btn-block">
                            <i class="fab fa-google fa-fw"></i> Register with Google
                        </a>
                        <a href="index.html" class="btn btn-facebook btn-user btn-block">
                            <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                        </a>
                        -->
                        <?php
                   if (isset($_POST['submit'])) {
                    // Get form data
                    $nombre = $_POST['nombre'];
                    $apPaterno = $_POST['apPaterno'];
                    $apMaterno = $_POST['apMaterno'];
                    $nomUsuario = $_POST['nomUsuario'];
                    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password for security
                    $ci = $_POST['ci'];
                
                    // Connect to the database
                    $conn = mysqli_connect("localhost", "root", "", "db_portalweb");
                    if (!$conn) {
                        die("Connection failed: " . mysqli_connect_error());
                    }
                
                    // Prepare the SQL statement to prevent SQL injection
                    $stmt = mysqli_prepare($conn, "INSERT INTO usuario (nombre, apPaterno, apMaterno, nomUsuario, password, ci) VALUES (?, ?, ?, ?, ?, ?)");
                
                    // Bind parameters
                    mysqli_stmt_bind_param($stmt, "ssssss", $nombre, $apPaterno, $apMaterno, $nomUsuario, $password, $ci);
                
                    // Execute the statement
                    if (mysqli_stmt_execute($stmt)) {
                        // Registration successful
                        echo "Registration successful!";
                        header('Location: index.php');
                         exit();
                    } else {
                        // Registration failed
                        echo "Error: " . mysqli_stmt_error($stmt);
                    }
                
                    // Close the statement and connection
                    mysqli_stmt_close($stmt);
                    mysqli_close($conn);
                }


                        ?>
                    </form>
                    
                    <div class="text-center">
                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                    </div>
                    <div class="text-center">
                        <a class="small" href="login.html">Already have an account? Login!</a>
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
