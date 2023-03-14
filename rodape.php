<?php 

echo "<footer>";

echo "<p class='rodape'>Acessado por ". $_SERVER['REMOTE_ADDR'] ." em ". date('d/m/y'). "</p>";
echo "<p class='rodape'>Desenvolvido por Alexandre S. Mendes &copy; 2021 </p>";

echo "</footer>";

$banco->close();

?>
