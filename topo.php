<?php 

echo "<header>";
if (empty($_SESSION['user'])){
    echo "<a href='user-login.php'>Entrar</a>";
}else{
    echo "Olá,<STRONG> " .$_SESSION['nome'] ."</STRONG>  você é ";
    if (is_admin()){
        echo "Administrador ";
    }elseif(is_editor()){
        echo "Usuário Editor ";
    }
    echo "<a href='user-edit.php'> Meus Dados |</a>";
    echo "<a href='coisa-new.php'> Cadastrar Coisas |</a>";
    if (is_admin()){
        echo " <a href='user-new.php'>Novo usuário |</a>";
    }
    echo "<a href='user-logout.php'> Sair</a>";
    
}

echo "</header>";

?>
