<?php

    include("php/conexao.php");
    session_start();

    
if(!$_SESSION['usuarioEmail']){
	header('Location: pagin-login.php');
	exit();
}



    $cliente_id = intval($_GET['id_cliente']);

    $sql_code = "DELETE FROM CLIENTE WHERE id_cliente = '$cliente_id'";
    $sql_query = $mysqli->query($sql_code) or die($mysqli->error);

    if($sql_query)
        echo "<script> location.href='listagem-cliente.php';</script>";
    else echo "<script> alert('Não foi possível deletar o cliente.'); location.href='cliente-funcionario';</script>";    
?>