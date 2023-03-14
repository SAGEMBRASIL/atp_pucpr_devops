<!--FORMULARIO DE INSERÇÃO DE UMA COISA NOVA -->

<link rel="stylesheet" href="css/formularioestilo.css">
<h1>Cadastrar uma coisa nova</h1>
    <form action="coisa-new.php" method="post">
        <label for="nome">Nome da coisa: </label>
        <input type="text" name="nome" id="nome" maxlength="100">
        <label for="descricao">Descrição da coisa:</label>
        <input type="text" name="descricao" id="descricao" maxlength="250">
        <label for="dias">Quantos dias poderá ser emprestado?</label>
        <input type="number" name="dias" id="dias" max='99'>
        <label for="foto">Foto da coisa:</label>
        <input type="file" name="foto" id="foto">
        <label for="ativo">Disponibilizar para empréstimo</label>
        <label for="ativo">Ativar para emprestimo</label>
        <select name="ativo" id="ativo">
            <option value="1" selected> SIM </option>
            <option value="0" > NÃO</option>
        </select> 
        <input type="submit" value="Finalizar Cadastro">
        



    </form>
