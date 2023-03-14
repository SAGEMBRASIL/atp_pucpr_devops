<!--FORMULARIO DE EDIÇÃO DE COISAS -->

<link rel="stylesheet" href="css/formularioestilo.css">
<?php 
include_once 'topo.php';
require_once 'models/banco.php';
$q = "SELECT id, usuario_id, nome, descricao, diasparaemprestar, imagem, ativo FROM coisa WHERE id = $_GET[cod]";
$busca = $banco->query($q)->fetch_object();
$id = $_GET['cod'];

if(!$busca|| is_null($busca) || empty($busca)){
    echo msg_erro("COISA NÃO ENCONTRADA");
    echo voltar();
    die();
}
?>


<h1>Editar uma coisa</h1>
    <form action="coisa-edit.php" method="post">
        <label for="id">Id da coisa</label>
        <input type="number" name="id" id="id" value="<?php echo $id?>" readonly>
        <label for="nome">Nome da coisa: </label>
        <input type="text" name="nome" id="nome" maxlength="100" value="<?php echo $busca->nome?>">
        <label for="descricao">Descrição da coisa:</label>
        <input type="text" name="descricao" id="descricao" maxlength="250" value="<?php echo $busca->descricao?>">
        <label for="dias">Quantos dias poderá ser emprestado?</label>
        <input type="number" name="dias" id="dias" max='99' value="<?php echo $busca->diasparaemprestar?>">
        <label for="foto">Foto atual:</label>
        <img src="<?php echo thumb($busca->imagem)?>">
        <img src="fotos/<?php thumb($busca->imagem) ?>" alt="">
        <input type="file" name="foto" id="foto">
        <label for="ativo">Ativar para emprestimo</label>
        <select name="ativo" id="ativo">
            <option value="1" <?php if($busca->ativo == 1){echo "selected";}?>> SIM </option>
            <option value="0" <?php if($busca->ativo == 0){echo "selected";}?>>NÃO</option>
        </select> 
        <input type="submit" value="Finalizar Cadastro">
        



    </form>
