<!DOCTYPE html>
<!--PROCESSO A EDIÇÃO DE COISAS -->
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/formularioestilo.css">
    <title>Edição Coisa - Coisas Emprestadas</title>
    <?php 
    require_once "models/banco.php";
    require_once "models/functions.php";
    require_once "models/login.php";
   
    
    ?>
</head>

<body>
    
    <div id="corpo">
        <?php 
            // verifico se o usuário está logado chamando a função is_logado, do arquivo functions.php:
            if(!is_logado()){
                echo msg_erro("Efetue <a href='user-login.php'>login</a> para acessar essa página.");   
            // verifico se foi passado dados no POST, se não, carrego o arquivo formulario:    
            }if(!isset($_POST['id'])){
                include 'coisa-edit-form.php';
                echo voltar();
            }else{
                
                // se teve o isset de $_POST, carrego as informações nas variáveis:
                $id = $_POST['id'] ?? null;
                $nome = $_POST['nome'] ?? null;
                $descricao = $_POST['descricao']??null;
                $dias = $_POST['dias'] ?? null;
                $foto = $_POST['foto'] ?? null;
                $ativo = $_POST['ativo'] ?? null;
                
                // crio o começo da query para gerar o update no banco:
                $update = "UPDATE coisa SET ";
                
                /*verifico se houve alteração nas informações para fazer o update no banco, 
                campos sem alteração não serão modificados, economizando carga no SGBD.*/
                if($nome != null || !empty($nome)){
                    $update .= " nome='$nome' "; 
                }
                if($descricao != null || !empty($descricao)){
                    $update .= " ,descricao='$descricao' "; 
                }

                if($dias != null || !empty($dias)){
                    $update .= " ,diasparaemprestar='$dias' "; 
                }

                if($foto != null || !empty($foto)){
                    $update .= " ,foto='$foto' "; 
                }

                if($ativo != null || !empty($ativo)){
                    $update .= " ,ativo='$ativo' "; 
                }



                if(empty($id) || is_null($id)){
                    echo msg_erro("ERRO, AUSENCIA DE COISA PARA ALTERAR!");
                }else{
                    $update .= " WHERE id='$id' ";
                    coisa_update($update);
                }
            }
        ?>
        
        
            
        
        
   
    </div>
    
</body>
</html>