<?php include 'resources\componentes\header\header.php';?>
<main class="d-flex flex-no-wrap">
    <?php include 'resources\componentes\sidebar\sidebar.php'; ?>
    <div class="container-dashboard">
        <div class="container-fluid sub-container">
            <div class="container-grafico-ticket-semanais">
                <div class="info-grafico">
                    <h3>Seus tickets na semana</h3>
                    <p>Acompanhe a quantidade de tickets que são de sua responsabilidade nessa semana.</p>
                </div>
                <div id="grafico-tickets-semanais">
                    <canvas id="barChart"></canvas>
                </div>
            </div>
        </div>
        <div class="container-fluid container-tickets">
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th>
                            <input type="checkbox" name="all" id="all">
                            <label for="all"></label>
                        </th>
                        <th class="col">Status do Ticket</th>
                        <th class="col">ID</th>
                        <th class="col">Assunto</th>
                        <th class="col">Solicitante</th>
                        <th class="col">Ult. Atualização</th>
                        <th class="col">Grupo</th>
                        <th class="col">Atribuido</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>
                            <input type="checkbox" name="all" id="all">
                            <label for="all"></label>
                        </th>
                        <td>Aberto</td>
                        <td>#2</td>
                        <td>TICKET DE EXEMPLO: Produto danificado</td>
                        <td>Taylor Moore</td>
                        <td>Quarta feira 16:06</td>
                        <td>Suporte</td>
                        <td>Gustavo de Camargo Campos</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</main>
<script>
    // Dados do PHP
    var dadosPHP = <?php echo json_encode($data); ?>;

    // Encontre o elemento canvas
    var ctx = document.getElementById('barChart').getContext('2d');

    // Crie o gráfico de barras
    var barChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira'], // Substitua pelas suas etiquetas
            datasets: [{
                label: 'Tickets do dia',
                data: dadosPHP,
                backgroundColor: '#FF8F6B',
                borderColor: 'transparent'
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
<?php include 'resources\componentes\footerDashboard\footerDashboard.php';?>
