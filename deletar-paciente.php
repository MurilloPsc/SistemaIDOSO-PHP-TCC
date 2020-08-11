<?php

    include("php/conexao.php");
    session_start();

    
if(!$_SESSION['usuarioEmail']){
	header('Location: pagin-login.php');
	exit();
}



    $paciente_id = intval($_GET['id_paciente']);

    $sql_code = "DELETE FROM PACIENTE WHERE id_paciente = '$paciente_id'";
    $sql_query = $mysqli->query($sql_code) or die($mysqli->error);

    if($sql_query)
        echo "<script> location.href='listagem-paciente.php';</script>";
    else echo "<script> alert('Não foi possível deletar o cliente.'); location.href='cliente-funcionario';</script>";    
?>