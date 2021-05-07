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
        'submenu' => [
            'index' => [
                'title' => 'Historial',
                'route' => 'shipping.index'
            ]
        ]
    ],

    'clients' => [
        'title' => 'Clientes',
        'icon' => 'fa fa-user',
        'submenu' => [
            'index' => [
                'title' => 'Lista',
                'route' => 'client.index'
            ]
        ]
    ],

    'inventory' => [
        'title' => 'Inventario',
        'icon' => 'fa fa-pie-chart',
        'submenu' => [
            'index' => [
                'title' => 'Productos',
                'route' => 'product.index'
            ]
        ]
    ],

    'credit' => [
        'title' => 'Crédito',
        'icon' => 'fa fa-credit-card',
        'submenu' => [
            'index' => [
                'title' => 'Ventas',
                'route' => 'deposit.credits'
            ]
        ]
    ],

    'prices' => [
        'title' => 'Precios',
        'icon' => 'fa fa-dollar',
        'submenu' => [
            'index' => [
                'title' => 'Lista',
                'route' => 'price.index'
            ]
        ]
    ],

    'reports' => [
        'title' => 'Reportes',
        'icon' => 'fa fa-line-chart',
        'submenu' => [
            'index' => [
                'title' => 'Menú',
                'route' => 'report.menu'
            ]
        ]
    ],

    'logout' => [
        'title' => 'Sesión',
        'icon' => 'fa fa-sign-out',
        'submenu' => [
            'index' => [
                'title' => 'Salir',
                'route' => 'getout',
            ]
        ]
    ],
];
