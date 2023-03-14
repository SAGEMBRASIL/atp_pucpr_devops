<!DOCTYPE html>
<!--DETALHES DE UMA COISA -->
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/formularioestilo.css">
    <title>Coisas Emprestadas</title>
    <?php 
    require_once "models/banco.php";
    require_once "models/functions.php";
    require_once "models/login.php";
    ?>
</head>

<body>

    <div id="corpo">
    <?php 
        include_once "topo.php";
        $id = $_GET['cod'] ?? 0;
        $q = "select * from coisa";
        $busca = $banco->query("select * from coisa where id = '$id'");
        
    ?>
     <h1>Detalhes da coisa...</h1>

     <table class='detalhes'>
         <?php 
            
            if(!$busca){
                echo "Busca falhou! $banco->error";
            }else {
                if ($busca->num_rows == 0){
                    echo "<p>Lamento, mas não há coisas com o parametro informado.</p>";
                    echo "<p>Tente novamente!</p>";
                }elseif ($busca->num_rows == 1){
                   
                    $reg = $busca->fetch_object();
              

                    $t = thumb($reg->imagem);
                    $a = estaAtivo($reg);
                    echo "<tr class='imagem'>";
                    echo "<td rowspan='4'><img src='$t' alt='Imagem do $reg->nome' class='full'></td>";
                    echo "<td><h2>$reg->nome</h2>";
                    echo "Disponível para empréstimo: $a</td>";
                    echo "<tr>";
                    echo "<td>";
                    echo "<h4>Detalhes:</h4>$reg->descricao";
                    if(is_logado()){
                        echo "<p>";
                        if(!match_usuario($reg->id)){
                            echo "<strong> Propietário: </strong>";
                            echo (detalhes_coisa($reg->id)->usuario_nome);
                            echo "<p>";
                            echo "<strong> Endereço: </strong>";
                            echo (detalhes_coisa($reg->id)->usuario_logradouro);
                            echo " ".(detalhes_coisa($reg->id)->usuario_cidade);
                            echo "<p>";
                            echo "<strong> Contatos: </strong>";
                            echo "<p>";
                            echo " ".(detalhes_coisa($reg->id)->usuario_email);
                            echo " ".(detalhes_coisa($reg->id)->usuario_telefone);

                        }else{
                            echo msg_aviso("ESSE ITEM É SEU!");
                        }
                        

                    }
                    
                    echo "</td>";
                    echo "<tr><td>Máximo de dias: $reg->diasparaemprestar</td>";
                    echo "<tr>";
                    // Administrador pode EDITAR editar qualquer item:
                    if (is_admin()){
                        echo "<td>";
                        //echo    "<a href='detalhes.php?cod=$reg->id'> <i class='material-icons'>add_circle</i></a>";
                        echo    "<a href='coisa-edit.php?cod=$reg->id'><i class='material-icons'>edit</i></a>";
                        //echo    "<i class='material-icons'>delete</i> </td>"; 
                    }elseif (is_editor()){
                        echo "<td>";
                        
                        
                        if(match_usuario($reg->id)){
                            
                            //echo "<a href='coisa-delete.php'> <i class='material-icons'>delete</i></a>"; 
                            
                            echo "<a href='coisa-edit.php?cod=$reg->id'><i class='material-icons'>edit</i></a>";
                            echo " </td>";
                        }
                        
                        
                    }
                   
                    echo "</tr>";
                } 
            }
            
            
        ?>
     </table>
     <?php 
     if (!is_logado()){
        echo msg_aviso("Faça o <a href='user-login.php'> login </a> para emprestar !");
     }
     ?>
     <a href="index.php"><img src="icones\voltar_pq.png" alt="VOLTAR"></a>
    </div>
    
</body>

<?php 
if(is_logado()){
    if (!match_usuario($reg->id)){
        if($reg->ativo==1){
            include 'emprestimo-form.php';
        }else{
            echo "<div id='corpo'>";
            echo msg_aviso("Item não está ativo para emprestimo!");
            echo "</div>";
        }
        
        
    }else{
        echo "<div id='corpo'>";
        echo msg_aviso("Essa coisa é <strong>SUA</strong>, você não pode emprestar, mas pode editar os dados se quiser!");
        echo "</div>";
    }
   
}
include_once "rodape.php"; ?>
</html>