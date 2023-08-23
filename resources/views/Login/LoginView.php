<?php include 'resources\views\componentes\navbar\navbar.php'?>
<?php include 'resources\views\componentes\notificacao\notificacao.php'?>

<div class="container-login">
    <form action="/login-process" method="post" class="form-login">
        <div class="header-form-login">
            <h1 class="titulo-form-login">Entre no sistema</h1>
        </div>

        <p class="form-group">
            <label for="email-login" class="label-email-login">Email:</label>
            <input type="email" name="email-login" id="email-login" class="input-email-login" value="<?= $_POST['email_login'] ?? '' ?>" required>
        </p>

        <p class="form-group">
            <label for="senha-login" class="label-senha-login">Senha:</label>
            <input class="input-senha-login" type="password" name="senha-login" id="senha-login" required>
        </p>

        <button type="submit" class="botao-login">Registrar</button>
    </form>
</div>

<?php include 'resources\views\componentes\footer\footer.php'?>
