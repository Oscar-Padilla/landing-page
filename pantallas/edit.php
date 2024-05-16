<?php
$servername = "localhost";
$username = "root";
$password = "oscaroziel";
$database = "sas";

#Crear la conexion
$connection = new mysqli($servername, $username, $password, $database);

$ID = "";
$nombre = "";
$apellido = "";
$curp = "";
$tel = "";
$edad = "";
$email = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD']=='GET') {
    if (!isset($_GET["ID_CLI"])) {
        header("location:ClientesExistentes.php");
        exit;
    }
    $ID = $_GET["ID_CLI"];
    $sql = "SELECT * FROM clientes WHERE ID_CLI=$ID";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location:ClientesExistentes.php");
        exit;
    }

    $nombre = $row["Nombre"];
    $apellido = $row["Apellido"];
    $curp = $row["CURP"];
    $tel = $row["Telefono"];
    $edad = $row["Edad"];
    $email = $row["Correo"];

}
else {
    $ID = $_POST["ID_CLI"];
    $nombre = $_POST["Nombre"];
    $apellido = $_POST["Apellido"];
    $curp = $_POST["CURP"];
    $tel = $_POST["Telefono"];
    $edad = $_POST["Edad"];
    $email = $_POST["Correo"];

    do {
        if (empty($ID) || empty($nombre) || empty($apellido) || empty($curp) || empty($tel) || empty($edad) || empty($email)) {
            $errorMessage = "Todos los espacios son requeridos";
            break;
        }

        $sql = "UPDATE clientes SET Nombre='$nombre', Apellido='$apellido', CURP='$curp', Telefono='$tel', Edad='$edad', Correo='$email' WHERE ID_CLI=$ID";
        $result = $connection->query($sql);
        if (!$result) {
            $errorMessage = "Sentencia invalida " . $connection->error;
            break;
        }
        $successMessage = "Cliente actualizado correctamente";

        header("location:ClientesExistentes.php");
        exit;

    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="Validaciones.js"></script>
    <link rel="stylesheet" href="style1.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="shortcut icon" href="https://cloud.aguascalientes.tecnm.mx/site/img/logo.png">
    <title>SAS</title>
</head>
<body>
    <nav class="navbar navbar-light navbar-expand-md fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="ClientesExistentes.php">Volver</a>
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
                    <h6 class="brand-heading" style="font-size: 380%;">Actualizar cliente</h6><br>
                    
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
                        <form name="form" method="POST">
                            <input type="hidden" name="ID_CLI" id="ID" value="<?php echo $ID; ?>">
                            <div class="grid gap-6 mb-6 md:grid-cols-2">
                                <div>
                                    <label for="first_name" style="color: white; font-size: larger;" class="block mb-2 text-sm font-medium text-gray-900">Nombre/s</label>
                                    <input type="text" name="Nombre" id="first_name" value="<?php echo $nombre; ?>" oninput="validacion_first(document.form.first_name)" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Juan" required>
                                </div>
                                <div>
                                    <label for="last_name" style="color: white; font-size: larger;" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Apellido/s</label>
                                    <input type="text" name="Apellido" id="last_name" value="<?php echo $apellido; ?>" oninput="validacion_last(document.form.last_name)" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Pérez" required>
                                </div>
                                <div>
                                    <label for="curp" style="color: white; font-size: larger;" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">CURP</label>
                                    <input type="text" name="CURP" id="curp" value="<?php echo $curp; ?>" oninput="mayusculas(event)" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="CURP" required>
                                </div>  
                                <div>
                                    <label for="phone" style="color: white; font-size: larger;" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Número Telefónico</label>
                                    <input type="tel" name="Telefono" id="phone" value="<?php echo $tel; ?>" oninput="validacion_tel(document.form.phone)" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="012-345-6789" required>
                                </div>
                                <div>
                                    <label for="edad" style="color: white; font-size: larger;" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Edad</label>
                                    <input type="number" name="Edad" value="<?php echo $edad; ?>" oninput="validacion_edad(document.form.edad)" id="edad" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required>
                                </div>
                            </div>
                            <div class="mb-6">
                                <label for="email" style="color: white; font-size: larger;" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Correo Electrónico</label>
                                <input type="email" name="Correo" id="email" value="<?php echo $email; ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="juan.perez@email.com" required>
                            </div> 
                            <button type="submit" id="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Actualizar</button>
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