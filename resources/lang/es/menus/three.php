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
            'processed' => [
                'title' => 'Procesado',
                'route' => 'processed.index'
            ],
        ]
    ],

    'shippings' => [
        'title' => 'Embarques',
        'icon' => 'fa fa-truck',
        'route' => 'shipping.index'
    ],

    'clients' => [
        'title' => 'Clientes',
        'icon' => 'fa fa-user',
        'route' => 'client.index'
    ],

    'inventory' => [
        'title' => 'Inventario',
        'icon' => 'fa fa-pie-chart',
        'route' => 'product.index'
    ],

    'credit' => [
        'title' => 'Crédito',
        'icon' => 'fa fa-credit-card',
        'route' => 'deposit.credits'
    ],

    'prices' => [
        'title' => 'Precios',
        'icon' => 'fa fa-dollar',
        'route' => 'price.index'
    ],

    'reports' => [
        'title' => 'Reportes',
        'icon' => 'fa fa-line-chart',
        'route' => 'report.menu'
    ],

    'logout' => [
        'title' => 'Cerrar Sesión',
        'icon' => 'fa fa-sign-out',
        'route' => 'getout',
    ],
];
