<?php
require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

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

$sql = "SELECT ID_CIT, clientes.Nombre, clientes.Apellido, Secre, FechaReg, FechaCi, Motivo, clientes.Correo FROM citas INNER JOIN clientes ON (citas.ID_CLI = clientes.ID_CLI)";
$result = $connection->query($sql);

$row_cnt = $result->num_rows;
if ($row_cnt>0) {

    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'sas.ita.itic@gmail.com';
    $mail->Password = 'oscaroziel2110';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = '465';

    $mail->setFrom('sas.ita.itic@gmail.com', 'Remitente');
    $mail->Subject = 'SAS nueva Cita';

    while ($row = $result->fetch_assoc()) {

        $nombre = $row["Nombre"]." ".$row["Apellido"];
        $email = $row["Correo"]; 

        $mail->addAddress($email);

        $mail->Body = "Nombre del cliente: $nombre \n";
        $mail->Body = "Secretaria/o: ".$row["Secre"]."\n";
        $mail->Body = "Fecha de registro: ".$row["FechaReg"]."\n";
        $mail->Body = "Fecha de su cita: ".$row["FechaCi"]."\n";
        $mail->Body = "Motivo de su cita: ".$row["Motivo"]."\n";

        $mail->clearAddresses();
    }

}
?>