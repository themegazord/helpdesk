<?php include 'resources/views/componentes/navbar/navbar.php'?>
    <div class="header">
        <h1>Bem-vindo ao Helpdesk!</h1>
        <p>Sua solução para suporte e atendimento ao cliente.</p>
    </div>

    <div class="container">
        <div class="solucoes">
            <div class="solucao">
                <h2>Atendimento 24/7</h2>
                <p>Estamos sempre disponíveis para ajudar, a qualquer hora do dia ou da noite.</p>
            </div>
            <div class="solucao">
                <h2>Suporte Personalizado</h2>
                <p>Nossa equipe de especialistas está pronta para oferecer suporte personalizado.</p>
            </div>
            <div class="solucao">
                <h2>Respostas Rápidas</h2>
                <p>Garantimos respostas rápidas para suas dúvidas e problemas.</p>
            </div>
        </div>

        <div class="contato-button">
            <a href="contato.html">Entre em Contato</a>
        </div>
    </div>

    <div class="testemunhas">
        <h2>O que nossos clientes dizem</h2>
        <div class="testemunhas-container">
            <div class="testemunha">
                <p>"Excelente serviço! O suporte foi rápido e eficaz, resolveram meu problema em minutos."</p>
                <p class="autor">- Maria Silva</p>
            </div>
            <div class="testemunha">
                <p>"Nunca vi um atendimento tão bom quanto o do Helpdesk. Recomendo a todos."</p>
                <p class="autor">- João Santos</p>
            </div>
        </div>
    </div>

    <div class="form-contato">
        <h2>Entre em Contato</h2>
        <form action="enviar-contato.php" method="post">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="mensagem">Mensagem:</label>
            <textarea id="mensagem" name="mensagem" rows="4" required></textarea>

            <button type="submit">Enviar</button>
        </form>
    </div>
<?php include 'resources/views/componentes/footer/footer.php'?>