<?php
include ("php/conexao.php");

		 $sql_code_clie = "SELECT * FROM PACIENTE ";
		 $sql_query_clie = $mysqli->query($sql_code_clie) or die($mysqli->error);
		 $cliente = $sql_query_clie->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Ficha diaria</title>

    <!-- Common plugins -->
    <link href="plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="plugins/simple-line-icons/simple-line-icons.css" rel="stylesheet">
    <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="plugins/pace/pace.css" rel="stylesheet">
    <link href="plugins/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="plugins/nano-scroll/nanoscroller.css">
    <link rel="stylesheet" href="plugins/metisMenu/metisMenu.min.css">
    <link href='plugins/fullcalendar/fullcalendar.css' rel="stylesheet">
    <!--for checkbox-->
    <link href="plugins/iCheck/blue.css" rel="stylesheet">
    <!--template css-->
    <link href="css/style.css" rel="stylesheet">
	
	 <link href='css/core/main.min.css' rel='stylesheet' />
        <link href='css/daygrid/main.min.css' rel='stylesheet' />
        <script src='js/core/main.min.js'></script>
        <script src='js/interaction/main.min.js'></script>
        <script src='js/daygrid/main.min.js'></script>
        <script src='js/core/locales/pt-br.js'></script>
        <link rel="icon" type="imagem/png" href="images/Logo.png" />

</head>

<body>
    <!--top bar start-->
    <div class="top-bar light-top-bar">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-6">
                    <a href="index.php" class="admin-logo">
                        <h1><img src="images/logo-dark.png" alt=""></h1>
                    </a>
                    <div class="left-nav-toggle visible-xs visible-sm">
                        <a href="">
                            <i class="glyphicon glyphicon-menu-hamburger"></i>
                        </a>
                    </div>
                    <!--end nav toggle icon-->

                </div>
                <div class="col-xs-6">
                    <ul class="list-inline top-right-nav">
                        
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- top bar end-->

    <!--left navigation start-->
    <aside class="float-navigation light-navigation">
        <div class="nano">
            <div class="nano-content">
                <ul class="metisMenu nav" id="menu">
                    <li class="nav-heading"><span></span></li>
                    <!-- <li><a href="index.html"><i class="fa fa-diamond"></i> Inicio </a></li> -->
                    <li><a href="dadosdiarios.php"><i class="fa fa-user"></i> Dados Diários </a></li>
                    <li><a href="calendario.php"><i class="fa fa-calendar"></i> Histórico Paciente </a></li>
                    <li><a href="gerenciamento.php"><i class="fa fa-server"></i> Gerenciamento </a></li>
                    <li><a href="page-login.php"><i class="fa fa-sign-in"></i> Sair </a></li>
                </ul>
            </div>
            <!--nano content-->
        </div>
        <!--nano scroll end-->
    </aside>
    <!--left navigation end-->


    <!--main content start-->
    <section class="main-content">



        <!--page header start-->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Histórico Paciente</h3>
                </div>
            </div>
        </div>
        <!--page header end-->


        <!--start page content-->

		<form method="POST" action="calendario.php">
		
			<label>Data à consultar: </label>
			<input type="date" name="criado" ><br><br>
			<label>Paciente à consultar: </label>
			<select name="id_paciente" class="form-control m-bv" required >
				 <option><font style="vertical-align: inherit;"></font></option>						 
				 <?php
				 do{
				 ?>
				 <option value="<?php echo $cliente['id_paciente']?>" name="id_paciente"><?php echo $cliente['nome_paciente']; ?></option>						 
				 <?php } while($cliente = $sql_query_clie->fetch_assoc());?>
										 
			 </select> <br> 
			<!-- <input  type="submit" value="Consultar"> <br> <br> -->
			 <input class = "btn btn-primary" name="SendPesqUser" type="submit" value="Consultar"> <br> <br>
			<?php 
			$SendPesqUser = filter_input(INPUT_POST, 'SendPesqUser', FILTER_SANITIZE_STRING);
			if($SendPesqUser){
				$id_paciente = filter_input(INPUT_POST, 'id_paciente', FILTER_SANITIZE_STRING);
				$criado = filter_input(INPUT_POST, 'criado', FILTER_SANITIZE_STRING);
				$result_usuario = "SELECT * FROM diario WHERE id_paciente = '$id_paciente' AND criado = '$criado' ";
				$resultado_usuario = mysqli_query($mysqli, $result_usuario);
				while($row_usuario = mysqli_fetch_assoc($resultado_usuario)){
					echo "ID Paciente: " . $row_usuario['id_paciente'] . "<br>";
					echo "Tipo de Refeição: " . $row_usuario['tipo_ref'] . "<br>";
					echo "Tipo de Acompanhamento: " . $row_usuario['tipo_acom'] . "<br>";
					echo "Descrição: " . $row_usuario['descricao'] . "<br>";
					echo "Medicação: " . $row_usuario['medicacao'] . "<br>";
					echo "Horário: " . $row_usuario['hora'] . "<br>";
					echo "Dosagem: " . $row_usuario['dosagem'] . "<br>";
					echo "Intervalo: " . $row_usuario['intervalo'] . "<br>";
					echo "Observação: " . $row_usuario['observacao'] . "<br><br><br> ";
				}
			}
		?>
		</form><br><br>
		
		


        <!--end page content-->


        <!--Start footer-->
        <footer class="footer">
            <span>Copyright &copy; 2020. Coofix</span>
        </footer>
        <!--end footer-->

    </section>
    <!--end main content-->



    <!--Common plugins-->
    <script src="plugins/jquery/dist/jquery.min.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="plugins/pace/pace.min.js"></script>
    <script src="plugins/jasny-bootstrap/js/jasny-bootstrap.min.js"></script>
    <script src="plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="plugins/nano-scroll/jquery.nanoscroller.min.js"></script>
    <script src="plugins/metisMenu/metisMenu.min.js"></script>
    <script src="js/float-custom.js"></script>
    <!--page script-->
    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="plugins/momentJs/moment.min.js"></script>
    <script src="plugins/fullcalendar/fullcalendar.min.js"></script>
    <!--ichecks-->
    <script src="plugins/iCheck/icheck.min.js"></script>
   
</body>

</html>
© 2020 GitHub, Inc.
Terms
Privacy
Security
Status
Help
Contact GitHub
Pricing
API
Training
Blog
About
