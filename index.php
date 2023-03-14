<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php 
    require_once "models/banco.php";
    require_once "models/functions.php";
    require_once "models/login.php";
    
    $ordem = $_GET['o'] ?? "nome";
    $buscar = $_GET['buscaCoisa'] ?? "";
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Coisas Emprestadas - Básico</title>
</head>

<body>
    <div id="corpo">
    <?php include_once "topo.php";?>
     <h1>Coisas para emprestar</h1>
        <form action="index.php" method="get" id="busca">
        Ordenar: 
        <a href="index.php?o=nome&buscaCoisa=<?php echo $buscar;?>">Nome | </a>
        <a href="index.php?o=cidade&buscaCoisa=<?php echo $buscar;?>">Cidade | </a>
        <a href="index.php?o=dispo&buscaCoisa=<?php echo $buscar;?>">Disponibilidade | </a>
        <a href="index.php?o=dias&buscaCoisa=<?php echo $buscar;?>">+ Dias Emprestimo |</a>
        <a href="index.php?o=ultimo&buscaCoisa=<?php echo $buscar;?>">+ Recentes |</a>
        <a href="index.php?">Mostrar Todos |</a>
        Buscar: <input type="text" name="buscaCoisa" id="busca" size="10" maxlength="40">
        <input type="submit" value="Buscar">
        </form>

    
     <table class="listagem">
         <?php 
            
            $q = "select c.id, c.nome, c.descricao, c.diasparaemprestar, c.imagem, c.ativo, u.nome unome, u.cidade, u.telefone, u.email from coisa as c join  usuario as u on c.usuario_id = u.id";
            $o = $ordem;
            // incluido novo comentário
            // Faço a busca no banco de dados para retornar a lista de coisas disponíveis:
            //$q = "select * from coisa";
            
            $busca = $banco->query(buscarResultados($q,$o, $buscar));
            if(!$busca){
                echo "ERRO NA CONSULTA AO BANCO DE DADOS";
            }else {
                if ($busca->num_rows ==0){
                    echo "<p><strong>Lamento:</strong> NENHUMA COISA PARA EMPRESTAR ESTÁ CADASTRADA COM AS CARACTERISTICAS INFORMADAS...</p>";
                    echo "<p>Comece você cadastrando um item, ou volte em breve...</p>";
                }else{
                    // printo no html o resultado da busca:
                    while($reg=$busca->fetch_object()){
                        $t = thumb($reg->imagem);
                        echo    "<tr>";
                        echo    "<td><img src='$t' alt='$reg->imagem' class='mini'></td>";
                        echo    "<td><a href='detalhes.php?cod=$reg->id'>$reg->nome</a></td>";
                        echo    "<td>$reg->cidade</td>";
                        if (is_logado()){
                            if($reg->ativo == 1){
                                echo "<td> ATIVO </td>";
                            }elseif($reg->ativo == 2){
                                echo "<td> EMPRESTADO até" ;
                                $emprestimo_detalhes = emprestimo_detalhes($reg->id);
                                echo $emprestimo_detalhes->data_devolucao;
                                
                                $dia_de_hoje = date_format(date_create(date('Y/m/d')), 'Y-m-d H:i:s');
                                if($emprestimo_detalhes->data_devolucao < $dia_de_hoje){
                                    echo "<div class='atraso'>";
                                    echo "<H1> DEVOLUÇÃO ATRASADA </H1>";
                                    echo "</div>";
                                }
                                echo "</td>";
                            }else{
                                echo "<td> INDISPONÍVEL </td>";
                            }
                            
                        }
                        if (is_admin()){
                            echo    "<td> <a href='detalhes.php?cod=$reg->id'><i class='material-icons'>add_circle</i></a>";
                            echo    "<a href='coisa-edit.php?cod=$reg->id'><i class='material-icons'>edit</i></a>";
                            
                        }elseif (is_editor()){
                            echo "<td>";
                            if(match_usuario($reg->id)){
                                echo    "<a href='coisa-edit.php?cod=$reg->id'><i class='material-icons'>edit</i></a>";
                                    
                            }
                            echo    "<a href='detalhes.php?cod=$reg->id'> <i class='material-icons'>add_circle</i></a></td>"; 
                            

                        }
                        
                        echo    "</tr>";
                        
                    }
                }
            }

         ?>
        
            
     </table>
    </div>
    <div>
        <h1>"incluido alteracao"</h1>
    </div>
</body>

<?php include_once "rodape.php"; ?>

</html>