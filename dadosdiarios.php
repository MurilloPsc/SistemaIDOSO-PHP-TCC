<?php

	
    include("php/conexao.php"); 

    session_start();

    if(!$_SESSION['usuarioEmail']){
        header('Location: pagin-login.php');
        exit();
    }elseif ($_SESSION['nivel_acesso'] == 1) {
        header('Location: index.php');
    }else{


    foreach ($_POST as $chave => $valor) {
        $_SESSION[$chave] = $mysqli->real_escape_string($valor);
    }

    $sql_code_clie = "SELECT * FROM PACIENTE ";
    $sql_query_clie = $mysqli->query($sql_code_clie) or die($mysqli->error);
    $cliente = $sql_query_clie->fetch_assoc();

    //$id_paciente = isset($_POST[id_paciente]);

    
     



    if(isset($_POST['get_idpaciente'])){
        session_start();

        foreach ($_POST as $chave=>$valor){
            $_SESSION[$chave] = $mysqli->real_escape_string($valor);
        }

        // 2 - Validação dos dados
        if(strlen($_SESSION['id_paciente'])== 0 )
            $erro[] = "Escolha um paciente";


        
        echo "<script> location.href='dadosdiarios2.php?id_paciente=$_SESSION[id_paciente]';</script>";
        
            

    }
   
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dados Diarios</title>

    <!-- Common plugins -->
    <link href="plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="plugins/simple-line-icons/simple-line-icons.css" rel="stylesheet">
    <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="plugins/pace/pace.css" rel="stylesheet">
    <link href="plugins/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="plugins/nano-scroll/nanoscroller.css">
    <link rel="stylesheet" href="plugins/metisMenu/metisMenu.min.css">
    <!--jquery steps-->
    <link rel="stylesheet" href="plugins/jquery-steps/jquery-steps.css">
    <!--template css-->
    <link href="css/style.css" rel="stylesheet">
    <link href="plugins/iCheck/blue.css" rel="stylesheet">
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
                    <li><a href="dadosdiarios.php"><i class="fa fa-user"></i> Dados Diários </a></li>
                    <li><a href="calendario.php"><i class="fa fa-calendar"></i> Historico paciente </a></li>
                    <li><a href="gerenciamento.php"><i class="fa fa-server"></i> Gerenciamento </a></li>
                    <li><a href="sair10.php"><i class="fa fa-sign-in"></i> Sair </a></li>
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
                    <h4>Dados diários</h4>
                </div>

            </div>
        </div>
        <!--page header end-->

        <!--start page content-->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form id="example-form" method="POST" action="dadosdiarios.php">
                            <div>
                                <h3>Paciente</h3>
                                <section>
                                    <label for="userName">*Selecione o paciente que você quer adicionar informações na ficha diaria do pacinete</label>

                                    <select name="id_paciente" class="form-control m-bv" required >
                                            <option><font style="vertical-align: inherit;"></font></option>
                                            
                                            <?php
                                                do{
                                                    ?>
                                                    <option value="<?php echo $cliente['id_paciente']?>" name="id_paciente"><?php echo $cliente['nome_paciente']; ?></option>
                                                
                                                    <?php } while($cliente = $sql_query_clie->fetch_assoc());?>
                                            
                                        </select>
                                    <p>(*) Obrigatório</p>
                                </section>

                                <input type="submit" class="btn btn-primary" value="Proximo" name="get_idpaciente">
                                
                                </section>
                            </div>
								
								
                        </form>
                        </div>
                    </div>
                </div>
            </div>
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
    <!-- iCheck for radio and checkboxes -->
    <script src="plugins/iCheck/icheck.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue'
            });
        });
    </script>

    <!--jquery steps-->
    <script src="plugins/jquery-steps/jquery.steps.min.js"></script>
    <script src="plugins/jquery-validate/jquery.validate.min.js"></script>
    <script>
        $("#example-basic").steps({
            headerTag: "h3",
            bodyTag: "section",

            autoFocus: true
        });
        //steps with form
        var form = $("#example-form");
        form.validate({
            errorPlacement: function errorPlacement(error, element) {
                element.before(error);
            },
            rules: {
                confirm: {
                    equalTo: "#password"
                }
            }
        });
        form.children("div").steps({
            headerTag: "h3",
            bodyTag: "section",
            transitionEffect: "slideLeft",
            onStepChanging: function(event, currentIndex, newIndex) {
                form.validate().settings.ignore = ":disabled,:hidden";
                return form.valid();
            },
            onFinishing: function(event, currentIndex) {
                form.validate().settings.ignore = ":disabled";
                return form.valid();
            },
            onFinished: function(event, currentIndex) {
                alert("Submitted!");
            }
        });
    </script>

</body>
    <?php } ?>
</html>