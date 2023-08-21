<?php

return new class {
    public function up(): void {
        $sql = "alter table usuarios 
                add column codigo_verificacao varchar(6) null after usuario_email,
                add column verificado char(1) not null default 'N' after codigo_verificacao;";
    }

    public function down(): void {
        $sql = "alter table usuarios
                drop column codigo_verificacao,
                drop column verificado;";
    }
};