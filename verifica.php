<!-- Arquivo utilizado para verificar qual é o usuário logado -->
<?php
    	include_once "conectar.php";//importando conexão com arquivo conexao
        if(isset($_SESSION['idUsuario']) && !empty($_SESSION['idUsuario'])){
            include_once 'Usuario.php';// importando conexão com arquivo usuário
    
            $u = new Usuario(); 
            // trazendo as informações
            $Usuario_logado = $u->logado($_SESSION['idUsuario']); // acessando a classe logado
            $nomeUsuario = $Usuario_logado['nome']; // Identificando o usuário que está logado
        }
        else{
            header("Location: painel-login.html");
        }
?>