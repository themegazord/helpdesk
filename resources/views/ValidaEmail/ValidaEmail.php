<?php include 'resources\views\componentes\navbar\navbar.php'; ?>
    <div id="container-valida-email">
        <div class="container-form-valida-email">
            <div class="header-valida-email">
                <h1 class="titulo-valida-email">Validação de Email</h1>
                <p class="sub-titulo-valida-email">Insira seu email abaixo para continuar o processo de validação.</p>
            </div>
            <form action="/cadastro/validaemail/process" method="post" class="form-valida-email">
                <label for="email" class="label-email-valida-email">Email:</label>
                <input type="email" id="email" name="email" class="input-email-valida-email" required>
                <br>
                <button type="submit" class="botao-valida-email">Continuar</button>
            </form>
            <div class="footer-valida-email">
                <p class="info-valida-email">Nós iremos enviar um link de validação para o endereço de email fornecido.
                    Certifique-se de verificar sua caixa de entrada e pasta de spam.</p>
            </div>
        </div>
    </div>
<?php include 'resources\views\componentes\footer\footer.php'; ?>