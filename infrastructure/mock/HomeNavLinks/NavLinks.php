<?php

namespace infrastructe\mock\HomeNavLinks;
class NavLinks
{
    public function links(): array {
        return [
            [
                'url' => '/',
                'label' => 'Home',
            ],
            [
                'url' => '/cadastro',
                'label' => 'Registre-se',
            ],
            [
                'url' => '/login',
                'label' => 'Entre no sistema',
            ]
        ];
    }
}