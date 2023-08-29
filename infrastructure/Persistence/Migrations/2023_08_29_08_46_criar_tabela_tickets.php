<?php

return new class {

    public function up(): void {
        $sql = "
                create table if not exists tickets (
                    ticket_id int primary key auto_increment,
                    status varchar(10) not null,
                    assunto varchar(155) not null,
                    solicitante_id int,
                    ultima_att datetime,
                    grupo_ticket_id int,
                    responsavel_id int,
                    constraint FK_tickets_solicitante_id foreign key FK_tickets_solicitante_id (solicitante_id) references usuarios(usuario_id),
                    constraint FK_tickets_responsavel_id foreign key FK_tickets_responsavel_id (responsavel_id) references usuarios(usuario_id),
                    constraint FK_tickets_grupo_ticket_id foreign key FK_tickets_grupo_ticket_id (grupo_ticket_id) references grupos_tickets(grupo_ticket_id)
                );
            ";
    }

    public function down(): void {
        $sql = "
            alter table tickets drop foreign key FK_tickets_solicitante_id;
            alter table tickets drop foreign key FK_tickets_responsavel_id;
            alter table tickets drop foreign key FK_tickets_grupo_ticket_id;

            drop table tickets;
        ";
    }
};