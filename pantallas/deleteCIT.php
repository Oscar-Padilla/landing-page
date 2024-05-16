<?php
if (isset($_GET["ID_CIT"])) {
    $ID = $_GET["ID_CIT"];

    $servername = "localhost";
    $username = "root";
    $password = "oscaroziel";
    $database = "sas";

    #Crear la conexion
    $connection = new mysqli($servername, $username, $password, $database);

    $sql = "DELETE FROM citas WHERE ID_CIT=$ID";
    $connection->query($sql);   
}
header("location:CitasProgramadas.php");
exit;
?>