<!DOCTYPE html>
<!--CONTROLE EDIÇÃO DE USUARIO -->
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/formularioestilo.css">
    <title>Edição Usuário - Coisas Emprestadas</title>
    <?php 
    require_once "models/banco.php";
    require_once "models/functions.php";
    require_once "models/login.php";
    ?>
</head>

<body>
    
    <div id="corpo">
        <?php 
            $q = "SELECT senha FROM USUARIO WHERE email ='".$_SESSION['user']."'";
            $busca = $banco->query($q)->fetch_object();
            
            if(!is_logado()){
                echo msg_erro("Efetue <a href='user-login.php'>login</a> para acessar essa página.");             
            }else {
                if (!isset($_POST['email'])){
                    include 'user-edit-form.php';
                    echo voltar('user-edit.php');
                }else{
                    $usuario = $_POST['email'] ?? null;
                    $nome = $_POST['nome'] ?? null;
                    $senha1 = $_POST['senha1'] ?? null;
                    $senha2 = $_POST['senha2'] ?? null;                   
                    $logradouro = $_POST['logradouro'] ?? null;
                    $cidade = $_POST['cidade'] ?? null;
                    $uf = $_POST['uf'] ?? null;
                    $telefone = $_POST['telefone'] ?? null;
                    $foto = $_POST['foto'] ?? null;

                    $q = "UPDATE usuario SET ";

                    if(empty($senha1) || is_null($senha1)){
                        echo msg_aviso("SENHA NÃO FOI ALTERADA!");
                        $senha = $busca->senha;
                        $q .= " senha='$senha'";
                        

                    }else{
                        if($senha1 === $senha2){
                            $senha = gerarHash($senha1);
                            $q .= " senha='$senha'";
                        }else{
                            echo msg_erro("SENHAS NÃO SÃO IDÊNTICAS! Retorne e confira a digitação.");
                            echo voltar("user-edit.php");
                            die();
                            
                        }
                        
                    }
                    if($nome != null || !empty($nome)){
                        $q .= " ,nome='$nome'"; 
                    }
                    if($logradouro != null || !empty($logradouro)){
                        $q .= " ,logradouro='$logradouro'"; 
                    }
                    if($cidade != null || !empty($cidade)){
                        $q .= " ,cidade='$cidade'"; 
                    }
                    if($uf != null || !empty($uf)){
                        $q .= " ,uf='$uf'"; 
                    }
                    if($telefone != null || !empty($telefone)){
                        $q .= " ,telefone='$telefone'"; 
                    }
                    if($foto != null || !empty($foto)){
                        $q .= " ,foto='$foto'"; 
                    }
                    
                    // fecho a query:
                    $q .= " where email ='$usuario'";
                    
                    if($banco->query($q)){
                        logout();
                        echo msg_sucesso("Usuário alterado com sucesso!");
                        echo msg_aviso("Por motivos de segurança, faça o <a href='user-login.php'>login</a> novamente");
                    }else{
                        echo msg_erro("ERRO: Não foi possível alterar os dados.");
                        
                    }
                  
                    
                    echo voltar("index.php");
                    
                }
                
            }
            
        
        ?>
   
    </div>
    
</body>
</html>