<!DOCTYPE html>
<!--CONTROLE DE INSERÇÃO DE UMA COISA NOVA -->
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/formularioestilo.css">
    <title>Cadastrar novo usuário - Coisas Emprestadas</title>
    <?php 
    require_once "models/banco.php";
    require_once "models/functions.php";
    require_once "models/login.php";
    
    ?>
</head>
<body>

<div id="corpo">
    
<?php 
$q = "SELECT id FROM USUARIO WHERE email ='".$_SESSION['user']."'";
$busca = $banco->query($q)->fetch_object();
    include_once 'topo.php';
    if(!is_logado()){
        echo msg_erro("Faca o <a href='user-login.php'>login</a> para cadastrar coisas.");
    }else{
        if(!isset($_POST['nome'])){
            include_once 'coisa-new-form.php';
        }else{
            $usuario_id = user_id($_SESSION['user']);
            $nomecoisa = $_POST['nome'] ?? null;
            $descricao = $_POST['descricao'] ?? null;
            $dias = $_POST['dias'] ?? null;
            $foto = $_POST['foto'] ?? null;
            $ativo = $_POST['ativo'] ?? true;

            insert_new_coisa($usuario_id, $nomecoisa, $descricao, $dias, $foto, $ativo);

        }
        
    }
 
    echo voltar()  ;
?>
 </div>
    <?php include_once 'rodape.php' ?>
   
 </body>

</html>