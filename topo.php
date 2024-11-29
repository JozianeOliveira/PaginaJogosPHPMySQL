<?php 
echo "<header>";
if (empty($_SESION['user'])) {
    echo "<a href= 'user-login.php'>Entrar</a>";
} else {
    echo "Olá, " . $_SESSION['user'];
}
echo "</header>";
?>