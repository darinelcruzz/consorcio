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
            'movements' => [
                'title' => 'Movimientos',
                'route' => 'movement.index'
            ],
        ]
    ],

    'credit' => [
        'title' => 'Crédito',
        'icon' => 'fa fa-credit-card',
        'submenu' => [
            'credits' => [
                'title' => 'Listado',
                'route' => 'deposit.credits'
            ],
            'deposits' => [
                'title' => 'Abonos',
                'route' => 'deposit.index'
            ],
        ]
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
