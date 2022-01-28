<!-- Realizando a validação dos Dados de Login -->
<?php 
if(isset($_POST['login']) && !empty($_POST['login']) &&  isset($_POST['senha']) && !empty($_POST['senha'])){
    // Incluindo a conexão com o Banco de Dados
    include_once "conectar.php";
    // Incluindo a conexão com o arquivo Usuario.php
    include_once "Usuario.php";
    //Estanciando o Objeto
    $u = new Usuario();
    $login = addslashes($_POST['login']); //Recebe a variável por meio do método POST
    $senha = addslashes($_POST['senha']); // addslashes é utilizado para não deixar o hacker manipular os dados
    // Se os dados retornados forem verdadeiros, ele irá conferir se a sessão existe
    if($u->login($login,$senha) == true ){
        if(isset($_SESSION['idUsuario'])){
            header("Location: index.php"); // Redireciona para dentro do sistema Web
        }
        else{
            header("Location: painel-login.html"); //Redireciona para o Painel de Login
        }
    }else{
        header("Location: painel-login.html"); //Redireciona para o Painel de Login
    }
}
else{
    header("Location: painel-login.html"); //Redireciona para o Painel de Login
}

?>