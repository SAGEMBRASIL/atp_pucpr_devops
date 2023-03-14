<!DOCTYPE html>
<!--CONTROLE  DE EMPRESTIMOS -->
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Emprestimo</title>
    <?php 
    require_once "models/banco.php";
    require_once "models/functions.php";
    require_once "models/login.php";
    ?>
</head>

<body>
    
    <div id="corpo">
        <?php 
            echo "<pre>";
            $id_coisa = $_POST['id_coisa'];
            $id_proprietario = detalhes_coisa($id_coisa)->usuario_id;
            $id_locador = user_id($_SESSION['user']);
            $hoje = date('Y/m/d');
            $data = date_format(date_create($hoje), 'Y-m-d H:i:s');
           // $data = date('d/m/y');
            $dias_emprestimo = $_POST['diasemprestimo'];
            $dia_devolução = date('Y/m/d', strtotime('+'. $dias_emprestimo .'days'));
            $data_devolução = date_format(date_create($dia_devolução), 'Y-m-d H:i:s');
            
            
                    
           emprestar($id_coisa, $id_proprietario, $id_locador, $data, $data_devolução);
           echo voltar();

        ?>
    </div>
</body>
</html>