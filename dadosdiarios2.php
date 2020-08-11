<?php

	
    include("php/conexao.php"); 

    

    session_start();

    if(!$_SESSION['usuarioEmail']){
        header('Location: pagin-login.php');
        exit();
    }elseif ($_SESSION['nivel_acesso'] == 1) {
        header('Location: index.php');
    }else{

    date_default_timezone_set('America/Sao_Paulo');

    $id_paciente = intval($_GET['id_paciente']);
    

    $sql_code_pac = "SELECT * FROM PACIENTE WHERE id_paciente = '$id_paciente' ";
    $sql_query_pac = $mysqli->query($sql_code_pac) or die($mysqli->error);
    $paciente = $sql_query_pac->fetch_assoc();

    $sql_code_enfermidade = "SELECT * FROM ENFERMIDADE WHERE id_paciente = '$id_paciente' ";
    $sql_query_enfermidade = $mysqli->query($sql_code_enfermidade) or die($mysqli->error);
    $enfermidade = $sql_query_enfermidade->fetch_assoc();

    $sql_code_restricao = "SELECT * FROM RESTRICAO WHERE id_paciente = '$id_paciente' ";
    $sql_query_restricao = $mysqli->query($sql_code_restricao) or die($mysqli->error);
    $restricao = $sql_query_restricao->fetch_assoc();

    $sql_code_remedio = "SELECT * FROM REMEDIO WHERE id_paciente = '$id_paciente' ";
    $sql_query_remedio = $mysqli->query($sql_code_remedio) or die($mysqli->error);
    $remedio = $sql_query_remedio->fetch_assoc();

    $sql_code_cliente = "SELECT * FROM CLIENTE WHERE id_paciente = '$id_paciente' ";
    $sql_query_cliente = $mysqli->query($sql_code_cliente) or die($mysqli->error);
    $cliente = $sql_query_cliente->fetch_assoc();
    
    //$data_nascimento = $paciente['data_nascimento'];


    $data = $paciente['data_nascimento'];

    // separando yyyy, mm, ddd
    list($ano, $mes, $dia) = explode('-', $data);

    // data atual
    $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
    // Descobre a unix timestamp da data de nascimento do fulano
    $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);

    // cálculo
    $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);


    if(isset($_POST['proximo'])){
        
        
        echo "<script> location.href='dadosdiarios3.php?id_paciente=$_SESSION[id_paciente]';</script>";

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
                        
                            <div>
                                <!-- GUIA2 -->
                            
                                <h3>Perfil</h3>
                                <section>
                                    <div class="col-md-6">
                                        <label for="name">Nome completo</label>
                                        <?php do{ ?>
                                        <input id="nome_paciente" name="name" type="text" value="<?php echo $paciente['nome_paciente'];  ?>" disabled="">
                                   
                                        <?php } while( $paciente = $sql_query_pac->fetch_assoc()); ?>
                                            
                                        </div>
                                    <div class="col-md-6">
                                        <label for="idade">Idade</label>
                                        <input id="idade" name="idade" type="text" width="100%" value="<?php echo $idade; ?> Anos" disabled="">
                                    </div>

                                    <!-- remedios -->
                                    <div class="col-md-3">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Enfermidades</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                <?php do{ ?>
                                                <tr>    
                                                    <td>1 </td>
                                                    <td><?php echo $enfermidade['nome_enfermidade'];  ?> </td>
                                                </tr>    
                                                    <?php } while( $enfermidade = $sql_query_enfermidade->fetch_assoc()); ?>
                                              
                                                
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- alergias -->
                                    <div class="col-md-3">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Restrição alimentar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php do{ ?>
                                                <tr>    
                                                    <td>1 </td>
                                                    <td><?php echo $restricao['nome_restricao'];  ?> </td>
                                                </tr>    
                                                    <?php } while( $restricao = $sql_query_restricao->fetch_assoc()); ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="col-md-6">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Medicação</th>
                                                    <th>Dose</th>
                                                    <th>Intervalo</th>
                                                    <th>Observação</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php do{ ?>
                                                <tr>    
                                                    <td>1 </td>
                                                    <td><?php echo $remedio ['nome_remedio']; ?> </td>
                                                    <td><?php echo $remedio ['dose_remedio']; ?> </td>
                                                    <td><?php echo $remedio ['intervalo_remedio']; ?> </td>
                                                    <td><?php echo $remedio ['observacao_remedio']; ?> </td>
                                                </tr>    
                                                    <?php } while( $remedio = $sql_query_remedio ->fetch_assoc()); ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <br>

                                    <!-- parentes -->
                                    <div class="col-md-12">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Principal</th>
                                                    <th>Código</th>
                                                    <th>Nome</th>
                                                    <th>Parentesco</th>
                                                    <th>Telefone</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php do{ ?>
                                                <tr>    
                                                    <td>1 </td>
                                                    <td><?php echo $cliente ['id_cliente']; ?> </td>
                                                    <td><?php echo $cliente ['nome_cliente']; ?> </td>
                                                    <td><?php echo $cliente ['parentesco']; ?> </td>
                                                    <td><?php echo $cliente ['num_celu']; ?> </td>
                                                </tr>
                                                    <?php } while( $cliente = $sql_query_cliente ->fetch_assoc()); ?>
                                            </tbody>
                                        </table>
                                    </div>

                                </section>


                                
                            </div>
							
                            
                        
                        </div>
                        <form action="dadosdiarios2.php" method="POST">
                        <input type="submit" class="btn btn-primary" value="Proximo" name="proximo">
                        </form>	
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