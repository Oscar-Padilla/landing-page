<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="Validaciones.js"></script>
    <link href="style1.css" rel="stylesheet" />
    <link rel="shortcut icon" href="https://cloud.aguascalientes.tecnm.mx/site/img/logo.png">
    <title>SAS</title>
</head>
<body>
    <nav class="navbar navbar-light navbar-expand-md fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="PantallaPrincipal.php">Volver a la pantalla principal</a>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item nav-link">
                    <img src="../assets/img/logo_tecnm.png" width="200" style="filter: invert(100%) saturate(0%);">
                    <img src="../assets/img/Picsart_22-10-12_16-34-44-824.png" width="230">
                </li>
            </ul>
        </div>
    </div>
</nav>
<header class="masthead">
    <div class="intro-body">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h6 class="brand-heading" style="font-size: 380%;">Clientes Existentes</h6><br>
                    <h1 style="font-size: 100%;">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th hidden>ID</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>CURP</th>
                                    <th>Teléfono</th>
                                    <th>Edad</th>
                                    <th>Correo</th>
                                    <th>Opción</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $servername = "localhost";
                            $username = "root";
                            $password = "oscaroziel";
                            $database = "sas";

                            #Crear la conexion
                            $connection = new mysqli($servername, $username, $password, $database);

                            #Checar la conexion
                            if ($connection->connect_error) {
                                die("Conexion fallida: " . $connection->connect_error);
                            }

                            #leer toda la tabla
                            $sql = "SELECT * FROM clientes";
                            $result = $connection->query($sql);
                            if (!$result) {
                                die("Sentencia invalida: " . $connection->error);
                            }

                            #leer la info de cada fila
                            while ($row = $result->fetch_assoc()) {
                                echo "
                                <tr>
                                    <td hidden>$row[ID_CLI]</td>
                                    <td>$row[Nombre]</td>
                                    <td>$row[Apellido]</td>
                                    <td>$row[CURP]</td>
                                    <td>$row[Telefono]</td>
                                    <td>$row[Edad]</td>
                                    <td>$row[Correo]</td>
                                    <td>
                                        <a class='btn btn-primary btn-sm' href='edit.php?ID_CLI=$row[ID_CLI]'>Editar</a>
                                        <a class='btn btn-danger btn-sm' href='delete.php?ID_CLI=$row[ID_CLI]'>Eliminar</a>
                                    </td>
                                </tr>
                                ";
                            }
                            ?>
                            </tbody>
                        </table>
                    </h1>

                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="map-clean"></div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/js/script.min.js"></script>
</body>
</html>