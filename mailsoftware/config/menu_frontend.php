<?php
// Header menu
return [

    'items' => [
        [],
        [
            'title' => 'Prenotazioni',
            'root' => true,
            'page' => '/',
            'new-tab' => false,
            'auth' => [1,2],
        ],
        [
            'title' => 'Storico',
            'root' => true,
            'page' => '/storico',
            'new-tab' => false,
            'auth' => [1],
        ],
        [
            'title' => 'Viste',
            'root' => true,
            'page' => '',
            'new-tab' => false,
            'auth' => [1],
            'submenu' => [
                [
                    'title' => 'Dashboard',
                    'bullet' => 'dot',
                    'page' => '/viste/dashboard',
                    'auth' => [1],
                    'new-tab' => false,
                ],
                [
                    'title' => 'Mensile',
                    'bullet' => 'dot',
                    'auth' => [1],
                    'new-tab' => false,
                    'submenu' => [
                        [
                            'title' => 'Mensile Generale',
                            'bullet' => 'dot',
                            'page' => '/viste/mensile',
                            'auth' => [1],
                            'new-tab' => false,
                        ],
                        [
                            'title' => 'Totali Mensili Operatori',
                            'bullet' => 'dot',
                            'page' => '/viste/mensile/operatori',
                            'auth' => [1],
                            'new-tab' => false,
                        ],
                        [
                            'title' => 'Simonetta',
                            'bullet' => 'dot',
                            'page' => '/viste/mensile/simonetta',
                            'auth' => [1],
                            'new-tab' => false,
                        ],
                    ],
                ],
            ]
        ],
    ]

];
