<!DOCTYPE html>
<html lang="pt-br">
<?php 
    require_once "models/banco.php";
    require_once "models/functions.php";
    require_once "models/login.php";
    ?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Login - Coisas Emprestadas</title>
    <style>
        /* CSS apenas para essa pagina*/
        div#corpo{
            width: 270px;
            font-size: 15pt;   
        }
        td{
            padding: 10px;
        }

    </style>

</head>

<body>
    <div id="corpo">
        
        <?php 
            
            // se eu ja tiver usuário e senha:(mostra formulário)
            $u = $_POST['usuario'] ?? null;
            $s = $_POST['senha'] ?? null ;
            // se usuário ou senha null, chama arquivo com formulário para login:
            if (is_null($u) || is_null($s)){
                require "user-login-form.php";

            }else{
                $q = "SELECT  nome, email, senha, tipo_usuario  FROM USUARIO where email = '$u' LIMIT 1";
                $busca = $banco->query($q);
                
                
                if(!$busca){
                    
                    echo msg_erro('Falha ao acessar o banco');
                }else{
                    if ($busca->num_rows >0){

                    
                        $reg = $busca->fetch_object();
                        if (testarHash($s,$reg->senha)){
                            echo msg_sucesso("Logado com Sucesso!");
                            $_SESSION['user'] = $reg->email;
                            $_SESSION['nome'] = $reg->nome;
                            $_SESSION['tipo'] = $reg->tipo_usuario;//TODO: colocar tipo do usuario
                        }else{
                            echo msg_erro('Senha inválida! ');
                        }
                    }else{
                        echo msg_erro("Usuário Inválido!");
                    }   
                }

            }
            echo voltar();
            
        ?>
        
    </div>
    <?php include_once "rodape.php"; ?>

</body>
</html>