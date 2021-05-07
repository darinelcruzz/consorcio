<?php

return [
    'sales' => [
        'title' => 'Ventas',
        'icon' => 'fa fa-shopping-cart',
        'submenu' => [
            'alive' => [
                'title' => 'Vivo',
                'route' => ['sale.index', 'vivo']
            ],
            'fresh' => [
                'title' => 'Fresco',
                'route' => ['sale.index', 'fresco']//'fresh.index'
            ],
            'pork' => [
                'title' => 'Cerdo',
                'route' => ['sale.index', 'cerdo']//'pork.index'
            ],
            'processed' => [
                'title' => 'Procesado',
                'route' => ['sale.index', 'procesado']//'processed.index'
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
            'adjustments' => [
                'title' => 'Ajustes',
                'route' => 'adjustment.index'
            ],
            'movements' => [
                'title' => 'Movimientos',
                'route' => 'movement.index'
            ],
            'mortality' => [
                'title' => 'Mortalidad',
                'route' => 'adjustment.create'
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

    'reports' => [
        'title' => 'Reportes',
        'icon' => 'fa fa-line-chart',
        'submenu' => [
            'menu' => [
                'title' => 'Menú',
                'route' => 'report.menu'
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

    'users' => [
        'title' => 'Usuarios',
        'icon' => 'fa fa-user',
        'submenu' => [
            'index' => [
                'title' => 'Listado',
                'route' => 'user.index'
            ],
            'create' => [
                'title' => 'Crear',
                'route' => 'user.create'
            ],
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
