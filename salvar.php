<!-- Arquivo responsável por salvar as informações no Banco de Dados -->
<?php 
require_once 'conectar.php'; //Irá conectar ao banco somente para inserir o valor

// Para o envio das informações da usina FV, será utilizado o método GET

$irradiancia = $_GET['irradiancia']; // Irradiância
$temperaturaAmbiente = $_GET['temperaturaAmbiente']; // Potência
$temperaturaPlaca = $_GET['temperaturaPlaca']; // Temperatura Amb
$potencia = $_GET['potencia']; // Temperatura Placa

// Preparando a variável $sql para inserir as medidas na tabela grandezas do Banco de Dados

$sql = "INSERT INTO medidas(irradiancia, temperaturaAmbiente, temperaturaPlaca, potencia) VALUES (:irradiancia,:temperaturaAmbiente,:temperaturaPlaca,:potencia)";

// Preparando para realizar uma consulta dentro do Banco de Dados
 
$stmt = $pdo->prepare($sql);

// Inserindo os valores dos sensores no Banco de Dados

$stmt->bindParam(':irradiancia',$irradiancia);
$stmt->bindParam(':temperaturaAmbiente',$temperaturaAmbiente);
$stmt->bindParam(':temperaturaPlaca',$temperaturaPlaca);
$stmt->bindParam(':potencia',$potencia);

// Conferindo se os valores foram realmente inseridos no Banco de Dados

if($stmt->execute()){
    echo "Valores inseridos!";
}
else{
    echo "Erro ao inserir os valores!";
}
?>