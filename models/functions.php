<!--FUNÇÕES GERAIS DO SISTEMA -->

<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="css/style.css">
<?php 


    //verifica se não possui imagem, e carrega uma foto padrão para itens sem imagem disponivel:
    function thumb($arq){
        $caminho = "fotos/$arq";
        if(is_null($arq) || !file_exists($caminho)){
            return "icones\icon_small.png";
        }else{
            return $caminho;
        }
    }

    // Verifico se o item está ativo:
    function estaAtivo($reg){
        if($reg->ativo == 1){
            $ativo = 'SIM';
        }else{
            $ativo = 'NAO';
        }
        return $ativo;
    }
    
    
    // ordenar resultados no index:
    //TODO: ARRUMAR LÓGICA PARA ORDENAR RESULTADOS APÓS A BUSCA DE UM TERMO.
    function buscarResultados($q, $ordem, $busca){
        $q = $q;
        $o = $ordem;
        $b = $busca;
        if (empty($b)){
            switch ($o){
                case "nome":
                    $q .= " ORDER BY c.nome ";
                    return $q;
                    break;
                case "cidade":
                    $q .= " ORDER BY u.cidade";
                    return $q;
                    break;
                case "dispo":
                    $q .= " ORDER BY c.ativo";
                    return $q;
                    break;
                case "dias":
                    $q .= " ORDER BY c.diasparaemprestar desc";
                    return $q;
                    break;
                default:
                    $q .= " ORDER BY c.id DESC";
                        return $q;
                        break;
            
            }
        }
        else{
            $q .= " WHERE c.nome like '%$b%' 
                  OR c.descricao like '%$b%'    
                  OR u.nome like '%$b%'
                  OR u.cidade like '%$b%'
                   ";
            
            return $q;
        }
        
    }

    // MOSTRA MENSAGEM DE SUCESSO RECEBENDO PARAMETRO FRASE / MENSAGEM
    function msg_sucesso($msg){
        $resp = "<div class='sucesso'> <span class='material-icons'>check_circle_outline</span> $msg</div>";
        return $resp;
    }
    // MOSTRA MENSAGEM DE ALERTA RECEBENDO PARAMETRO FRASE / MENSAGEM
    function msg_aviso($msg){
        $resp = "<div class='aviso'> <span class='material-icons'>notification_important</span> $msg</div>";
        return $resp;
    }
    // MOSTRA MENSAGEM DE ERRO RECEBENDO PARAMETRO FRASE / MENSAGEM
    function msg_erro($msg){
        $resp = "<div class='erro'> <span class='material-icons'>error</span> $msg</div>";
        return $resp;   
    }

    // Mostra botão e volta para index.php
    function voltar($pagina = 'index.php'){
       echo "<a href='$pagina'><img src='icones/voltar_pq.png' alt='VOLTAR'></a> ";
    }



    // verificar se existe o usuário cadastrado no banco, retorna 1 ou 0;
    function usuario_existe($usuario){
        require 'banco.php';
        $q = " select exists( select * from usuario where email = '$usuario') ";
        
        $res = $banco->query($q)->fetch_row();
        return $res;
    


}
    // grava novo usuário no banco:
    function insert_new_user($senha, $nome, $cpf, $logradouro, $cidade, $uf, $telefone, $email, $tipo_usuario, $foto = ''){
        require 'banco.php';
        
        $senha = $senha;
        $nome = $nome;
        $cpf = $cpf;
        $logradouro = $logradouro;
        $cidade = $cidade;
        $uf = $uf;
        $telefone = $telefone;
        $email = $email;
        $tipo = $tipo_usuario;
        $foto = $foto;
            
        $q = "INSERT INTO usuario (nome, cpf, logradouro, cidade, uf, telefone, email, senha, foto, tipo_usuario) values ('$nome', '$cpf', '$logradouro', '$cidade', '$uf', '$telefone', '$email', '$senha', '$foto', $tipo) ";

        if (usuario_existe($email)[0]==1){
            echo msg_erro("O email $email, ja está cadastrado.");
            echo voltar("user-new.php");
        }else{
            if($banco->query($q)){
                echo msg_sucesso("Usuário <strong>$nome</strong> cadastrado com sucesso! O e-mail <strong>$email</strong> deve ser utilizado como login.");
                           
                echo "<p>Clique no botão para voltar para continuar a sua navegação</p>";
                echo voltar();
            }else{
                echo msg_erro("Não é possível cadastrar o usuário $email");
              
                echo voltar("user-new.php");
            }
    

        }
        
    

    }

    //edita os dados do usuario

  
    function user_edit($senha, $nome, $logradouro, $cidade, $uf, $telefone, $email, $foto=''){
        require 'banco.php';
                   
     
            
        $q = " UPDATE usuario SET nome ='$nome', logradouro='$logradouro', cidade='$cidade', uf='$uf', telefone='$telefone', foto='$foto', senha = '$senha' where email = '$email'  ";
             

       
        


        if($banco->query($q)){
            echo msg_sucesso("Usuário <strong>$nome</strong> cadastrado com sucesso! O e-mail <strong>$email</strong> deve ser utilizado como login.");
                    
            echo "<p>Clique no botão para voltar para continuar a sua navegação</p>";
            echo voltar();
        }else{
            echo msg_erro("Não é possível cadastrar o usuário $email");
        
            echo voltar("user-new.php");
        }


               
    }        
    
    // cadastro nova coisa no banco;
    function insert_new_coisa($usuario_id, $nome, $descricao, $dias, $foto = 'null', $ativo=true){
        require 'banco.php';
        $q = "INSERT INTO coisa (usuario_id, nome, descricao, diasparaemprestar, imagem, ativo) value('$usuario_id', '$nome', '$descricao', '$dias', 'null', '$ativo')";
        if($banco->query($q)){
            echo msg_sucesso("Coisa $nome cadastrada com Sucesso!");
        }
    }

    // consulto id do usuario:
    function user_id($email){
        require 'banco.php';
        $q = "SELECT id FROM usuario WHERE email = '$email'";
        if($banco->query($q)){
            $busca = $banco->query($q)->fetch_object();
            
            return $busca->id;
        }
       
    }
    // função que faz o update das coisas no banco:
    function coisa_update($q){
        require 'banco.php';
       
        if($banco->query($q)){
            echo msg_sucesso("DADOS FORAM ALTERADOS COM SUCESSO!");
            echo voltar();
            
            
        }

    }

    // verifica quantos dias a coisa pode ser emprestada:
    function dias_para_emprestar($id){
        require 'banco.php';
        $q = "SELECT diasparaemprestar FROM coisa where id='$id'";
        if($banco->query($q)){
            $dias = $banco->query($q)->fetch_object();
            if($dias){
                
                return($dias->diasparaemprestar);
            }else{
                echo msg_erro("ERRO DIAS PARA EMPRESTAR-> OBJETO NÃO ENCONTRADO NO BANCO");
                echo voltar();
                die();
            }
            
            
        }

    }

    //RETORNA OS DETALHES DE UMA COISA CADASTRADA
    function detalhes_coisa($id){
        require 'banco.php';
        $q = "select coisa.id as coisa_id, usuario.id as usuario_id, coisa.nome as coisa_nome, coisa.descricao as coisa_descricao, coisa.diasparaemprestar as diasparaemprestar, coisa.ativo as ativo, usuario.nome as usuario_nome, usuario.logradouro as usuario_logradouro, usuario.cidade as usuario_cidade, usuario.uf as usuario_uf, usuario.telefone as usuario_telefone, usuario.email as usuario_email, usuario.foto as usuario_foto from coisa  join usuario on coisa.usuario_id = usuario.id where coisa.id = '$id';";
        if($banco->query($q)){
            $res = $banco->query($q)->fetch_object();
            return $res;
        }else{
            echo "ERRO";
        }
    }

   // consulto o id do usuario ativo, com base no seu e-mail de login.
    function consulta_id_usuario($email){
        require 'banco.php';
        $q = "SELECT id FROM usuario WHERE email = '$email'";
        if($banco->query($q)){
            $res = $banco->query($q)->fetch_object();
            return $res;
        }else{
            echo msg_erro("ERRO AO CONSULTAR ID DO USUARIO NO BANCO -> consulta_id_usuario($email) functions.php");
        }

    }

    // verifico se o item foi cadastrado pelo usuario que está ativo passando o id da coisa, 

    function match_usuario($id_coisa){
        require 'banco.php';
        
        $busca = $banco->query("select * from coisa where id = '$id_coisa'");
        $reg = $busca->fetch_object();
        $detalhes = detalhes_coisa($reg->id);
                  
                        
        if($detalhes->usuario_id == consulta_id_usuario($_SESSION['user'])->id ){
            return true;
        }
    }

    function exclui_coisa($id_coisa){
        require 'banco.php';
        $q = " DELETE FROM coisa WHERE id = '$id_coisa'";
        if($busca->query($q)){
            msg_aviso("EXCLUIDO COM SUCESSO!");
        }else{
            msg_erro("ERO: NÃO FOI POSSIVEL EXCLUIR O ITEM!");
        }
    }

    // REGISTRO EMPRESTIMO NA TABELA EMPRESTIMO
    function emprestar($id_coisa, $id_proprietario, $id_locador, $data, $data_devolução){
        require 'banco.php';
        // QUERY -> registro os dados do emprestimo
        $q = "INSERT INTO emprestimo (id_coisa, id_proprietario, id_locador, data_emprestimo,data_devolucao) values ('$id_coisa', '$id_proprietario', '$id_locador', '$data', '$data_devolução') ";
        // QUERY -> seto o status da coisa para '2' = EMPRESTADA;
        $status = "UPDATE coisa SET ativo= 2 WHERE id='$id_coisa'";
        $busca = $banco->query($q);
        $altera_status = $banco->query($status);
        if($busca){
            if($altera_status){
                echo msg_sucesso("EMPRESTADO: A coisa foi emprestada retorne a página inicial.");
            }else{
                echo msg_erro("ERRO -> O empréstimo foi realizado, mas o status do item continua sem alteração! Entre em contato com o Administrador!");
            }
              
        }else{
            echo msg_erro("ERO: ALGO DEU ERRADO COM EMPRESTIMO - Operação não foi registrada.");
        }
       
    }

    // Retorna detalhes sobre o emprestimo do item passando qual a informação desejada.
    function emprestimo_detalhes($id_coisa){
        $q = "SELECT * FROM coisasemprestadas.emprestimo WHERE id_coisa = $id_coisa";
        require 'banco.php';
        $busca = $banco->query($q)->fetch_object();
        echo "<pre>";
        
        return $busca;
        
    
    }

    
    
        

    
  

    
    
   
?>