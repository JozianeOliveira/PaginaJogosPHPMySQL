<?php 
echo "<footer>";
echo "<p>Acessado por " . $_SERVER['REMOTE_ADDR'] . " em " . date('d/M/Y') . " </p>";
echo "<p>Desenvolvido por Joziane Oliveira &copy; 2024</p>";
$banco -> close(); 
?>
