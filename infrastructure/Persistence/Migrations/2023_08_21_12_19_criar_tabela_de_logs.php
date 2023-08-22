<?php

return new class {
    public function up(): void {
        $sql = "create table if not exists log (
                log_id int auto_increment primary key,
                data_log date not null,
                nivel varchar(10) not null,
                mensagem text not null);";
    }

    public function down(): void {
        $sql = "drop table if exists log;";
    }
};
