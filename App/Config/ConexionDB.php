<?php
class Conexion
{
    function getConexion()
    {
        $host = "localhost";
        $user = "root";
        $pass = "";
        $dbname = "conjunto";
        try{
            $con = new PDO("mysql:host=".$host.";dbname=".$dbname, $user, $pass);
            $con->exec("SET CHARACTER set utf8mb4");
            $con->exec("SET NAMES utf8mb4");
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $con;
        }catch (PDOException $e){
            die("Error al conectar con la base de datos: ".$e->getMessage());
        }
    }

    function cerrarConexion($conexion)
    {
        $conexion = null; // Asigna null a la conexión para cerrarla
    }
}
?>
