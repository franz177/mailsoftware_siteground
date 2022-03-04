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
                    'title' => 'Costi Gestione',
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
                            'page' => '/viste/mensile/costi_annuale_mesi',
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
                    'title' => 'Costi Aziendali',
                    'root' => true,
                    'page' => '/spese/costi_aziendali',
                    'new-tab' => false,
                    'auth' => [1,3],
                ],
                [
                    'title' => 'Costi Annuale per Anni [04]',
                    'bullet' => 'dot',
                    'page' => '/viste/mensile/costi_annuale_anno',
                    'auth' => [1],
                    'new-tab' => false,
                ],
                [
                    'title' => 'Incassi',
                    'bullet' => 'dot',
                    'page' => '/viste/incomes',
                    'auth' => [1,3],
                    'new-tab' => false,
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
                            'page' => '/marketing/countries',
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
                            'page' => '/sinottico',
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
        [
            'title' => 'Spese',
            'root' => true,
            'page' => '',
            'new-tab' => false,
            'auth' => [1,3],
            'submenu' => [
                [
                    'title' => 'Categorie',
                    'bullet' => 'dot',
                    'page' => '/spese/categorie',
                    'auth' => [1],
                    'new-tab' => false,
                ],
            ]
        ],
        [
            'title' => 'Scarica Excel',
            'root' => true,
            'page' => '/excel',
            'new-tab' => false,
            'auth' => [1],
        ],
    ]

];
