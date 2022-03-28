<?php
// Header menu
const DATE_FORMAT = 'd/m/Y';
$today = date(DATE_FORMAT);
$lastyear = date(DATE_FORMAT, strtotime('-1 year'));

return [

    'items' => [
        [],
        [
            'title' => 'Prenotazioni',
            'root' => true,
            'page' => '/',
            'new-tab' => false,
            'auth' => [1, 2],
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
            'auth' => [1, 3],
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
                    'auth' => [1, 3],
                    'new-tab' => false,
                    'submenu' => [
                        [
                            'title' => 'Costi Mensili Prenotazioni [02]',
                            'bullet' => 'dot',
                            'page' => '/viste/mensile',
                            'auth' => [1],
                            'new-tab' => false,
                        ],
                        [
                            'title' => 'Costi Annuali per Mesi [03]',
                            'bullet' => 'dot',
                            'page' => '/viste/mensile/costi_annuale_mesi',
                            'auth' => [1],
                            'new-tab' => false,
                        ],
                        [
                            'title' => 'Costi Annuali per Anni [04]',
                            'bullet' => 'dot',
                            'page' => '/viste/mensile/costi_annuale_anno',
                            'auth' => [1],
                            'new-tab' => false,
                        ],
                        [
                            'title' => 'Costi Aziendali',
                            'root' => true,
                            'page' => '/spese/costi_aziendali',
                            'new-tab' => false,
                            'auth' => [1, 3],
                        ],
                    ],
                ],
                [
                    'title' => 'Operatori',
                    'bullet' => 'dot',
                    'auth' => [1, 3],
                    'new-tab' => false,
                    'submenu' => [
                        [
                            'title' => 'Mensile Operatori [05]',
                            'bullet' => 'dot',
                            'page' => '/viste/mensile/operatori',
                            'auth' => [1, 3],
                            'new-tab' => false,
                        ],
                        [
                            'title' => 'Totali Mensili Operatori [05.1]',
                            'bullet' => 'dot',
                            'page' => '/viste/mensile/totali_operatori',
                            'auth' => [1, 3],
                            'new-tab' => false,
                        ],
                    ]
                ],
                [
                    'title' => 'Incassi',
                    'bullet' => 'dot',
                    'auth' => [1, 3],
                    'new-tab' => false,
                    'submenu' => [
                        [
                            'title' => 'Incassi Mensili Prenotazioni [06]',
                            'bullet' => 'dot',
                            'page' => '/viste/incassi/mensile',
                            'auth' => [1],
                            'new-tab' => false,
                        ],
                        [
                            'title' => 'Incassi Annuali per Mesi [07]',
                            'bullet' => 'dot',
                            'page' => '/viste/incassi/annuale_mesi',
                            'auth' => [1],
                            'new-tab' => false,
                        ],
                        [
                            'title' => 'Incassi Annuali per Anni [08]',
                            'bullet' => 'dot',
                            'page' => '/viste/incassi',
                            'auth' => [1],
                            'new-tab' => false,
                        ],
                    ],
                ],
                [
                    'title' => 'Marketing',
                    'bullet' => 'dot',
                    'auth' => [1, 3],
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
                            'title' => 'Dati demografici ospiti (Kross)',
                            'bullet' => 'dot',
                            'page' => 'https://alguerhome2.krossbooking.com/admin/stats#/admin/stats?period=' . $lastyear . '%20-%20' . $today . '&stat=8',
                            'auth' => [1],
                            'new-tab' => true,
                        ],
                        [
                            'title' => 'Provenienza Prenotazioni (Kross)',
                            'bullet' => 'dot',
                            'page' => 'https://alguerhome2.krossbooking.com/admin/stats#/admin/stats?period=' . $lastyear . '%20-%20' . $today . '&stat=1',
                            'auth' => [1],
                            'new-tab' => true,
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
                    'auth' => [1, 3],
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
            'auth' => [1, 3],
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
            'title' => 'Links',
            'root' => true,
            'page' => '/links',
            'new-tab' => false,
            'auth' => [1],
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
