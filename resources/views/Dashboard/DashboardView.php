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
            <div class="container-nps-prioridade">
                <div class="container-nps">
                    <h3>NPS: Satisfação do cliente</h3>
                    <p>Sua nota de NPS atualmente é: <?= $data['nps'] ?></p>
                </div>
                <div class="container-prioridade">
                    <h3>Prioridade dos seus tickets</h3>
                    <div class="prioridades">
                        <div class="prioridade">
                            <span class="titulo-prioridade">Baixa</span>
                            <span class="qntd-tickets"><?= $data['prioridade']['baixa'] ?></span>
                        </div>
                        <div class="prioridade">
                            <span class="titulo-prioridade">Normal</span>
                            <span class="qntd-tickets"><?= $data['prioridade']['normal'] ?></span>
                        </div>
                        <div class="prioridade">
                            <span class="titulo-prioridade">Alta</span>
                            <span class="qntd-tickets"><?= $data['prioridade']['alta'] ?></span>
                        </div>
                        <div class="prioridade">
                            <span class="titulo-prioridade">Urgente</span>
                            <span class="qntd-tickets"><?= $data['prioridade']['urgente'] ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid container-ticket-infos">
            <div class="container-tickets-por-prioridade">
                <div class="container-tickets-por-prioridade--baixa">
                    <h3>Baixa prioridade</h3>
                    <table class="table">
                        <thead class="table-secondary">
                            <tr>
                                <th>ID</th>
                                <th>Assunto</th>
                                <th>Solicitante</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>12</td>
                                <td>Ticket teste: Fudeu de vez</td>
                                <td>Cliente 1</td>
                            </tr>
                            <tr>
                                <td>12</td>
                                <td>Ticket teste: Fudeu de vez</td>
                                <td>Cliente 1</td>
                            </tr>
                            <tr>
                                <td>12</td>
                                <td>Ticket teste: Fudeu de vez</td>
                                <td>Cliente 1</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="container-tickets-por-prioridade--normal">
                    <h3>Normal prioridade</h3>
                    <table class="table">
                        <thead class="table-info">
                        <tr>
                            <th>ID</th>
                            <th>Assunto</th>
                            <th>Solicitante</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>12</td>
                            <td>Ticket teste: Fudeu de vez</td>
                            <td>Cliente 1</td>
                        </tr>
                        <tr>
                            <td>12</td>
                            <td>Ticket teste: Fudeu de vez</td>
                            <td>Cliente 1</td>
                        </tr>
                        <tr>
                            <td>12</td>
                            <td>Ticket teste: Fudeu de vez</td>
                            <td>Cliente 1</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="container-tickets-por-prioridade--alta">
                    <h3>Alta prioridade</h3>
                    <table class="table">
                        <thead class="table-warning">
                        <tr>
                            <th>ID</th>
                            <th>Assunto</th>
                            <th>Solicitante</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>12</td>
                            <td>Ticket teste: Fudeu de vez</td>
                            <td>Cliente 1</td>
                        </tr>
                        <tr>
                            <td>12</td>
                            <td>Ticket teste: Fudeu de vez</td>
                            <td>Cliente 1</td>
                        </tr>
                        <tr>
                            <td>12</td>
                            <td>Ticket teste: Fudeu de vez</td>
                            <td>Cliente 1</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="container-tickets-por-prioridade--urgente">
                    <h3>Urgente prioridade</h3>
                    <table class="table">
                        <thead class="table-danger">
                        <tr>
                            <th>ID</th>
                            <th>Assunto</th>
                            <th>Solicitante</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>12</td>
                            <td>Ticket teste: Fudeu de vez</td>
                            <td>Cliente 1</td>
                        </tr>
                        <tr>
                            <td>12</td>
                            <td>Ticket teste: Fudeu de vez</td>
                            <td>Cliente 1</td>
                        </tr>
                        <tr>
                            <td>12</td>
                            <td>Ticket teste: Fudeu de vez</td>
                            <td>Cliente 1</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div></div>
        </div>
    </div>
</main>
<script>
    // Dados do PHP
    var dadosPHP = <?php echo json_encode($data['tickets']); ?>;

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
