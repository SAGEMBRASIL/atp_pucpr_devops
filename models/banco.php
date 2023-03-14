<?php 

// Conexão com banco de dados:

$banco = new mysqli('localhost', 'root', '', 'coisasemprestadas');

if($banco->connect_errno) {
    
    echo "Erro $banco->errno  --> $banco->connect_error";
    echo "BANCO NAO INSTALADO";
    die();
}
$banco->query("SET NAMES 'utf8'");
$banco->query("SET character_set_connection=utf8");
$banco->query("SET character_set_client=utf8");
$banco->query("SET character_set_results=utf8");

return $banco;




?>