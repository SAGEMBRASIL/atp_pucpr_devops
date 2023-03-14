<!DOCTYPE html>
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
        if (!is_admin()){
            echo msg_erro("ÀREA RESTRITA ! Você não é um administrador! ");
            echo voltar();

        }else{
            if(!isset($_POST['email'])){
                require "user-new-form.php";
            }else{
                // usuário = email.
                $usuario = $_POST['email'] ?? null;
                $nome = $_POST['nome'] ?? null;
                $senha1 = $_POST['senha1'] ?? null;
                $senha2 = $_POST['senha2'] ?? null;
                $tipo = $_POST['tipo'] ?? null;
                $cpf = $_POST['cpf'] ?? null;
                $logradouro = $_POST['logradouro'] ?? null;
                $cidade = $_POST['cidade'] ?? null;
                $uf = $_POST['uf'] ?? null;
                $telefone = $_POST['telefone'] ?? null;
                $foto = $_POST['foto'] ?? null;

               // valido campo a campo verificando se algum não foi preenchido:

                if ($senha1 === $senha2){
                    if(empty($usuario)){
                        echo msg_aviso("Campo <strong>email</strong> não foi preenchido");
                        echo voltar('user-new.php');  
                    }elseif(empty($nome)){
                        echo msg_aviso("Campo <strong>nome</strong> não foi preenchido");
                        echo voltar('user-new.php');  
                    }elseif(empty($senha1)){
                        echo msg_aviso("Campo <strong>senha 1</strong> não foi preenchido");
                        echo voltar('user-new.php');  
                    }elseif(empty($senha2)){
                        echo msg_aviso("Campo <strong>senha 2</strong> não foi preenchido");
                        echo voltar('user-new.php');  
                    }elseif(empty($tipo)){
                        echo msg_aviso("Campo <strong>tipo usuário</strong> não foi preenchido");
                        echo voltar('user-new.php');  
                    }elseif(empty($cpf)){
                        echo msg_aviso("Campo <strong>cpf</strong> não foi preenchido");
                        echo voltar('user-new.php');  
                    }elseif(empty($logradouro)){
                        echo msg_aviso("Campo <strong>logradouro</strong> não foi preenchido");
                        echo voltar('user-new.php');  
                    }elseif(empty($cidade)){
                        echo msg_aviso("Campo <strong>cidade</strong> não foi preenchido");
                        echo voltar('user-new.php');  
                    }elseif(empty($uf)){
                        echo msg_aviso("Campo <strong>UF</strong> não foi preenchido");
                        echo voltar('user-new.php');  
                    }elseif(empty($telefone)){
                        echo msg_aviso("Campo <strong>telefone</strong> não foi preenchido");
                        echo voltar('user-new.php');  
                    }
                    
                    else{
                        $senha = gerarHash($senha1);
                        insert_new_user($senha, $nome, $cpf, $logradouro, $cidade, $uf, $telefone, $usuario, $tipo, $foto);
                        //echo msg_sucesso("Cadastrado com sucesso!");
                        //echo voltar();
                    }
                    
                }else{
                    echo msg_erro('As senhas digitadas não são idênticas!');
                    echo voltar('user-new.php');
                }
            }
            
        }
        
?>
 </div>
 </body>'

</html>