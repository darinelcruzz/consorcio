<?php

return [
    'clients' => [
        'title' => 'Clientes',
        'icon' => 'fa fa-user',
        'submenu' => [
            'add' => [
                'title' => 'Agregar',
                'route' => 'client.create'
            ],
            'list' => [
                'title' => 'Lista',
                'route' => 'client.index'
            ],
        ]
    ],

    'sales' => [
        'title' => 'Ventas',
        'icon' => 'fa fa-shopping-cart',
        'submenu' => [
            'pork' => [
                'title' => 'Cerdo',
                'route' => 'pork.index'
            ],
        ]
    ],

    'logout' => [
        'title' => 'Cerrar Sesión',
        'icon' => 'fa fa-sign-out',
        'route' => 'home',
    ],
];
