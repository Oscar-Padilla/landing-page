<?php
if (isset($_GET["ID_CLI"])) {
    $ID = $_GET["ID_CLI"];

    $servername = "localhost";
    $username = "root";
    $password = "oscaroziel";
    $database = "sas";

    #Crear la conexion
    $connection = new mysqli($servername, $username, $password, $database);

    $sql = "DELETE FROM clientes WHERE ID_CLI=$ID";
    $connection->query($sql);   
}
header("location:ClientesExistentes.php");
exit;
?>