<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "oscaroziel";
$database = "sas";

#Crear la conexion
$connection = new mysqli($servername, $username, $password, $database);

$cli="";
$secre="";
$fechareg="";
$fechaci="";
$motive="";

$successMessage="";
$errorMessage="";

if ($_SERVER['REQUEST_METHOD']=='POST') {
    $cli = $_POST["cliente"];
    $secre = $_POST["secre"];
    $fechareg = $_POST["fecha_reg"];
    $fechaci = $_POST["fecha_cit"];
    $motive = $_POST["motivo"];

    do {
        if (empty($cli) || empty($fechaci) || empty($motive)) {
            $errorMessage = "Todos los espacios son requeridos";
            break;
        }

        $sql = "INSERT INTO citas (ID_CLI, FechaReg, FechaCi, Secre, Motivo) VALUES ('$cli', '$fechareg', '$fechaci', '$secre', '$motive')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Sentencia invalida " . $connection->error;
            break;
        }

        $cli="";
        $secre="";
        $fechareg="";
        $fechaci="";
        $motive="";

        $successMessage = "Cita agregada correctamente";

        #include 'enviar_correo.php';

    } while (false);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="Validaciones.js"></script>
    <link href="style1.css" rel="stylesheet"/>
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
                    <h6 class="brand-heading" style="font-size: 380%;">Nueva Cita</h6><br>
                    
                    <?php
                    if (!empty($errorMessage)) {
                        echo "
                        <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                            <strong>$errorMessage</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                        ";
                    }
                    ?>
                    
                    <?php
                    if (!empty($successMessage)) {
                        echo "
                        <div class='row mb-3'>
                            <div class='offset-sm-3 col-sm-6'>
                                <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                    <strong>$successMessage</strong>
                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                </div>
                            </div>
                        </div>
                        ";
                    }
                    ?>
                    <h1 style="font-size: 100%;">
                        <form name="form" method="post">
                            <div class="grid gap-6 mb-6 md:grid-cols-2">
                                <div>
                                    <label for="clientes" style="color: white; font-size: larger;" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Seleccione el cliente</label>
                                    <select name=cliente id="clientes" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="0">Seleccione:</option>
                                    <?php
                                    $query="SELECT ID_CLI, Nombre FROM clientes";
                                    $res = $connection->query($query);
                                    
                                    if (!$res) {
                                        die("Sentencia invalida: " . $connection->error);
                                    }
                                    while ($row = $res->fetch_assoc()) {
                                        echo
                                        '<option value = "'.$row['ID_CLI'].'">'.$row['Nombre'].'</option>';
                                    }
                                    ?>
                                    </select>
                                </div>
                                <div>
                                    <label for="secre" style="color: white; font-size: larger;" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Secretaria/o</label>
                                    <input type="text" name="secre" id="secre" value="<?php echo $_SESSION["user"];?>" style="text-align:center;" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                </div>  
                                <div>
                                    <label for="fecha_reg" style="color: white; font-size: larger;" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha de Registro</label>
                                    <input type="date" name="fecha_reg" id="fechaReg" style="text-align: center;" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                </div>
                                <div>
                                    <label for="fecha_cit" style="color: white; font-size: larger;" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha de la Cita</label>
                                    <input type="date" name="fecha_cit" id="fechaCi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                </div>
                            </div>
                            <div class="mb-6">
                                <label for="motivo" style="color: white; font-size: larger;" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Motivo</label>
                                <textarea id="motivo" name="motivo" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Escribe el motivo de la cita..."></textarea>
                            </div> 
                            <button type="submit" id="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Registrar</button>
                            <button type="reset" id="reset" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Borrar</button>
                        </form>
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