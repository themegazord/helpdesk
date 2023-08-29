<?php

return new class {
    public function up(): void {
        $sql = "
            create table if not exists grupos_tickets (
                grupo_ticket_id int primary key auto_increment,
                nome varchar(20)
            );
        ";
    }

    public function down(): void {
        $sql = "
            drop table grupos_exists;
        ";
    }
};