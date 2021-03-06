<?php
require 'conexion/Config.php';
include 'aplicacion.php';

$id  = $_POST['id'];  
$tex = trim($_POST['not']);
//$tex  = str_replace('  ', ' ', $tex);
$tex = preg_replace('/( ){2,}/u',' ',$tex); 
$fec = $_POST['fec'];
$pri = $_POST['pri'];
 
$text = trim($tex);
try {
    $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE notas SET texto=trim(?),fecha=?,prioridad=? WHERE id=?";
    $stmt = $conn->prepare($sql);             
    $stmt->execute([trim($text),$fec,$pri,$id]);
    $filaAfectadas = $stmt->rowCount(); 
    
    if ($filaAfectadas) {
        header('Location: listar.php');    
    }
    

} catch (PDOException $ex) {
    echo "Error SQL: " .$sql." ".$ex->getMessage();
}
$conn = null;

