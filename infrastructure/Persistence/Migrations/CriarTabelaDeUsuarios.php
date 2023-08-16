<?php

class CriarTabelaDeUsuarios
{
    public function up() {
        $sql = "CREATE TABLE IF NOT EXISTS EXISTS usuarios(
                    usuario_id INT AUTO_INCREMENT PRIMARY_KEY,
                    usuario_nome VARCHAR(155) NOT NULL,
                    usuario_email VARCHAR(155) NOT NULL,
                    usuario_senha VARCHAR(255) NOT NULL)";
    }

    public function down() {
        $sql = "DROP TABLE IF EXISTS usuarios";
    }
}