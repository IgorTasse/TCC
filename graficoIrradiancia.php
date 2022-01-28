<!-- Importando o arquivo de conexão com o Banco de Dados -->
<?php
    include_once "conectar.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="src/css/styleGrafico.css">
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
</head>
<body>
<header class="cabecalho">
        <!-- Recebendo os dados do formulário -->
        <?php
            $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT); //Filtrando os dados
        ?>
        <form method="POST" action="#">
            <!-- Mantendo a data na caixa de pesquisa -->
                <div class="data">
                    <?php
                    $data_inicio = "";
                    if(isset($dados['data_inicio'])){
                        $data_inicio = $dados['data_inicio'];
                    }
                    ?>
                    <label class="texto">Data Inicial</label>
                    <input type="date" name="data_inicio" value="<?php echo $data_inicio;?>">
                    <!-- Mantendo a data na caixa de pesquisa -->
                    <?php
                    $data_final = "";
                    if(isset($dados['data_final'])){
                        $data_final = $dados['data_final'];
                    }
                    ?>
                    <label class="texto">Data Final</label>
                    <input type="date" name="data_final" value="<?php echo $data_final;?>">
                    <input class="botao" type="submit" value="Buscar" name="pesquisa_datas">
                </div>
        </form>
    </header>
    <main class="conteudo">
        <script type="text/javascript">
          google.charts.load('current', {'packages':['corechart']});
          google.charts.setOnLoadCallback(drawChart);

          function drawChart() {
            var data = google.visualization.arrayToDataTable([
              ['Data', 'Irradiância'],
            <?php
            //Verificando se o usuário clicou no botão
            if(!empty($dados['pesquisa_datas'])){
            // Selecionando os dados da tabela medidas que serão mostrados no período de data determinado
                $query_temperaturas = "SELECT Irradiancia,created FROM medidas WHERE created BETWEEN :data_inicio AND :data_final";
                $resultado = $pdo->prepare($query_temperaturas); //Preparando busca
                $resultado->bindParam(':data_inicio',$dados['data_inicio']);
                $resultado->bindParam(':data_final',$dados['data_final']);
                $resultado->execute();
           
                while($row_medidas = $resultado->fetch(PDO::FETCH_ASSOC)){


            ?>
              ['<?php echo"".$row_medidas['created']; ?>',<?php echo"".$row_medidas['Irradiancia']?>],
              <?php }}?>
            ]);

            var options = {
              title: 'Irradiância',
              curveType: 'function',
              legend: { position: 'bottom' }
            };

            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

            chart.draw(data, options);
          }
    </script>
        <div id="curve_chart""></div>
</body>
</html>