<!--FORMULARIO DE EMPRESTIMO -->
   

<?php 
    require_once "models/banco.php";
    require_once "models/functions.php";
    require_once "models/login.php";

    // recebo o id do produto pelo get, e verifico quantos por dias pode ser emprestado:
    $id = $_GET['cod'] ?? 0;
    $dias = dias_para_emprestar($id);  
        
        
        
?>

    <div id="corpo" >
            

    <form action="emprestimo.php" method="post">

            <input type="hidden" name="id_coisa" id="id_coisa" value="<?php echo($_GET['cod']);?>">
            <label for="datadevolucao">Por quantos dias você precisa dessa coisa?</label>
            <input type="number" name="diasemprestimo" id="diasemprestimo" maxlength="99" value="1" max='<?php echo $dias?>' min ='1'>
            <input type="submit" value="EMPRESTAR">
        </form>

       
    </div>
</body>
</html>