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
            'auth' => [1,3],
            'submenu' => [
                [
                    'title' => 'Dashboard Prenotazioni [01]',
                    'bullet' => 'dot',
                    'page' => '/viste/dashboard',
                    'auth' => [1],
                    'new-tab' => false,
                ],
                [
                    'title' => 'Costi',
                    'bullet' => 'dot',
                    'auth' => [1,3],
                    'new-tab' => false,
                    'submenu' => [
                        [
                            'title' => 'Mensile Generale Prenotazioni [02]',
                            'bullet' => 'dot',
                            'page' => '/viste/mensile',
                            'auth' => [1],
                            'new-tab' => false,
                        ],
                        [
                            'title' => 'Costi Annuale per Mesi [03]',
                            'bullet' => 'dot',
                            'page' => '/viste/mensile/simonetta',
                            'auth' => [1],
                            'new-tab' => false,
                        ],
                        [
                            'title' => 'Costi Annuale per Anni [04]',
                            'bullet' => 'dot',
                            'page' => '/viste/mensile/simonetta',
                            'auth' => [1],
                            'new-tab' => false,
                        ],
                        [
                            'title' => 'Operatori',
                            'bullet' => 'dot',
                            'auth' => [1,3],
                            'new-tab' => false,
                            'submenu' => [
                                [
                                    'title' => 'Mensile Operatori [05]',
                                    'bullet' => 'dot',
                                    'page' => '/viste/mensile/operatori',
                                    'auth' => [1,3],
                                    'new-tab' => false,
                                ],
                                [
                                    'title' => 'Totali Mensili Operatori [05.1]',
                                    'bullet' => 'dot',
                                    'page' => '/viste/mensile/totali_operatori',
                                    'auth' => [1,3],
                                    'new-tab' => false,
                                ],
                            ]
                        ],

                    ],
                ],
                [
                    'title' => 'Incassi',
                    'bullet' => 'dot',
                    'auth' => [1,3],
                    'new-tab' => false,
                    'submenu' => [
                        [
                            'title' => 'Mensile Generale Prenotazioni [06]',
                            'bullet' => 'dot',
                            'page' => '/viste/mensile',
                            'auth' => [1],
                            'new-tab' => false,
                        ],
                        [
                            'title' => 'Annuale per Mesi [07]',
                            'bullet' => 'dot',
                            'page' => '/viste/mensile',
                            'auth' => [1],
                            'new-tab' => false,
                        ],
                        [
                            'title' => 'Annuale per Anni [08]',
                            'bullet' => 'dot',
                            'page' => '/viste/mensile',
                            'auth' => [1],
                            'new-tab' => false,
                        ],
                    ],
                ],
                [
                    'title' => 'Marketing',
                    'bullet' => 'dot',
                    'auth' => [1,3],
                    'new-tab' => false,
                    'submenu' => [
                        [
                            'title' => 'Paesi',
                            'bullet' => 'dot',
                            'page' => '/viste/mensile',
                            'auth' => [1],
                            'new-tab' => false,
                        ],
                        [
                            'title' => 'Siti Web',
                            'bullet' => 'dot',
                            'page' => '/viste/mensile',
                            'auth' => [1],
                            'new-tab' => false,
                        ],
                        [
                            'title' => 'Numero Prenotazioni',
                            'bullet' => 'dot',
                            'page' => '/viste/mensile',
                            'auth' => [1],
                            'new-tab' => false,
                        ],
                        [
                            'title' => 'Data Prenotazioni',
                            'bullet' => 'dot',
                            'page' => '/viste/mensile',
                            'auth' => [1],
                            'new-tab' => false,
                        ],
                        [
                            'title' => 'Numero Ospiti',
                            'bullet' => 'dot',
                            'page' => '/viste/mensile',
                            'auth' => [1],
                            'new-tab' => false,
                        ],
                        [
                            'title' => 'Notti',
                            'bullet' => 'dot',
                            'page' => '/viste/mensile',
                            'auth' => [1],
                            'new-tab' => false,
                        ],
                    ],
                ],
                [
                    'title' => 'Tabelle Operative',
                    'bullet' => 'dot',
                    'auth' => [1,3],
                    'new-tab' => false,
                    'submenu' => [
                        [
                            'title' => 'Sinottico',
                            'bullet' => 'dot',
                            'page' => '/viste/mensile',
                            'auth' => [1],
                            'new-tab' => false,
                        ],
                        [
                            'title' => 'Andamento Prenotazioni',
                            'bullet' => 'dot',
                            'page' => '/viste/mensile',
                            'auth' => [1],
                            'new-tab' => false,
                        ],
                    ],
                ],
            ]
        ],
    ]

];
