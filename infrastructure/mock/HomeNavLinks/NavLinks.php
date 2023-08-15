<?php

namespace app\infrastructe\mock\HomeNavLinks;
class NavLinks
{
    public function links(): array {
        return [
            [
                'url' => '/',
                'label' => 'Home',
            ],
            [
                'url' => '/login',
                'label' => 'Entre no sistema',
            ],
            [
                'url' => '/cadastro',
                'label' => 'Registre-se',
            ]
        ];
    }
}