<?php include 'resources\componentes\navbar\navbar.php'; ?>
<?php include 'resources\componentes\notificacao\notificacao.php'; ?>
    <div id="container-valida-email">
        <div class="container-form-valida-email">
            <div class="header-valida-email">
                <h1 class="titulo-valida-email">Validação de Email</h1>
                <p class="sub-titulo-valida-email">Insira o código que foi encaminhado para o seu email.</p>
            </div>
            <form action="/cadastro/validaemail-process" method="post" class="form-valida-email">
                <input type="hidden" name="hash" value="<?php echo $_GET['usuario'] ?>">
                <label for="cod" class="label-cod-valida-email">Código:</label>
                <input type="cod" id="cod" name="cod" class="input-cod-valida-email" required>
                <br>
                <button type="submit" class="botao-valida-email">Continuar</button>
            </form>
            <div class="footer-valida-email">
                <p class="info-valida-email">Nós iremos enviar um código de validação para o endereço de email fornecido.
                    Certifique-se de verificar sua caixa de entrada e pasta de spam.</p>
            </div>
        </div>
    </div>
<?php include 'resources\componentes\footer\footer.php'; ?>