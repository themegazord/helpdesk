<?php if($_SERVER['REQUEST_METHOD'] == 'GET'): ?>
    <?php if(isset($_GET['erro'])): ?>
        <div id='notificacao-cadastro-usuario' class='notificacao'>
            <p><?= urldecode($_GET['erro']); ?></p>
        </div>
    <?php endif; ?>
<?php endif; ?>