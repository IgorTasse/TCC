<!-- Realizando a conexão com o Banco de Dados MySQL -->
<?php 
session_start(); //Iniciando sessão
$host = "localhost"; //Servidor onde está o Banco de Dados
$usuario = "root"; //Usuário padrão do Banco de Dados
$senha = ""; //Senha padrão do Banco de Dados
$banco = "tcc"; //Base de Dados
global $pdo; //Criando variável global para utilizar nos outros arquivos .php
//Realizando a comunicação com o Banco de Dados

try{
    $pdo = new PDO("mysql:dbname=". $banco ."; host". $host, $usuario, $senha);
    //echo "Conexão bem sucedida!";
}
// Caso a conexão não seja feita, será exibido uma mensagem de erro no navegador
catch(PDOException $erro){ //Responsável por capturar qualquer erro gerado no PDO
    echo "Conexão com o Banco de Dados falhou!";
}
?>