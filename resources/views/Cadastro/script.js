function mostraNotificacao() {
    const notificacao = document.getElementById('notificacao-cadastro-usuario');
    notificacao.style.opacity = 1;

    setTimeout(() => {
        notificacao.style.opacity = 0;
    }, 2000); // Define o tempo em milissegundos (2 segundos)

    setTimeout(() => {
        notificacao.style.display = 'none';
    }, 2500); // Remove o elemento após a animação de fade
}

mostraNotificacao();