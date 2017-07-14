<?php

return [
    'sales' => [
        'title' => 'Ventas',
        'icon' => 'fa fa-shopping-cart',
        'submenu' => [
            'alive' => [
                'title' => 'Vivo',
                'route' => 'alive.index'
            ],
            'fresh' => [
                'title' => 'Fresco',
                'route' => 'fresh.index'
            ],
            'pork' => [
                'title' => 'Cerdo',
                'route' => 'pork.index'
            ],
        ]
    ],

    'shippings' => [
        'title' => 'Embarques',
        'icon' => 'fa fa-truck',
        'submenu' => [
            'list' => [
                'title' => 'Historial',
                'route' => 'shipping.index'
            ],
            'add' => [
                'title' => 'Agregar',
                'route' => 'shipping.create'
            ],
        ]
    ],

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

    'inventory' => [
        'title' => 'Inventario',
        'icon' => 'fa fa-pie-chart',
        'submenu' => [
            'add' => [
                'title' => 'Productos',
                'route' => 'product.index'
            ],
        ]
    ],

    'logout' => [
        'title' => 'Cerrar Sesión',
        'icon' => 'fa fa-sign-out',
        'route' => 'home',
    ],
];
