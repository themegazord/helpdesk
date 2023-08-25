<?php include 'resources\componentes\navbar\navbar.php'; ?>
<?php include 'resources\componentes\notificacao\notificacao.php'; ?>
    <div class="container-cadastro-usuario">
        <form method="post" action="/cadastro-process" class="form-cadastro-usuario">

            <div class="header-form-cadastro-usuario">
                <h1 class="titulo-form-cadastro-usuario">Cadastre-se</h1>
            </div>

            <p class="form-group">
                <label for="nome-cadastro" class="label-nome-cadastro-usuario">Nome:</label>
                <input type="text" id="nome-cadastro" name="nome-cadastro" class="input-nome-cadastro-usuario" value="<?= $_POST['nome-cadastro'] ?? '' ?>">
            </p>

            <p class="form-group">
                <label for="email-cadastro" class="label-email-cadastro-usuario">Email:</label>
                <input type="email" id="email-cadastro" name="email-cadastro" class="input-email-cadastro-usuario" value="<?= $_POST['email-cadastro'] ?? ''?>">
            </p>

            <p class="form-group">
                <label for="senha-cadastro" class="label-senha-cadastro-usuario">Senha:</label>
                <input type="password" name="senha-cadastro" id="senha-cadastro" class="input-senha-cadastro-usuario" value="<?= $_POST['senha-cadastro'] ?? ''?>">
            </p>

            <button type="submit" class="botao-cadastro">Registrar</button>

            <div class="footer-form-cadastro-usuario">
                <p>Já possui conta? <a href="/login" class="link-login-cadastro">Entre no sistema</a></p>
            </div>
        </form>
    </div>
<?php include 'resources\componentes\footer\footer.php'; ?>