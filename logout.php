<!-- Arquivo utilizado para que o usuário só retorne ao Sistema Web após apertar o botão "sair", quando inserir os dados corretamente no Painel de Login -->
<?php
    include_once "conectar.php";
    unset($_SESSION['idUsuario']); //Finalizando a sessão
    header("Location: painel-login.html"); // Redirecionando para pagina login.php
?>