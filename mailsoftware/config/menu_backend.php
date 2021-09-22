<?php
// Header menu
return [

    'items' => [
        // Dashboard
        [
            'title' => 'Dashboard',
            'root' => true,
            'icon' => 'media/svg/icons/Design/Layers.svg', // or can be 'flaticon-home' or any flaticon-*
            'page' => '/backend',
            'new-tab' => false,
        ],

        // Testi
        [
            'section' => 'Testi',
        ],
        [
            'title' => 'Risposte',
            'icon' => 'media/svg/icons/Home/Library.svg',
            'bullet' => 'line',
            'root' => true,
            'page' => '/backend/flusso_testi',
        ],
        [
            'title' => 'Aggiungi Testo',
            'icon' => 'media/svg/icons/Files/File-plus.svg',
            'bullet' => 'dot',
            'root' => true,
            'page' => '/backend/testi/create',
        ],
        [
            'title' => 'Elenco Testi NON assegnati',
            'icon' => 'media/svg/icons/Layout/Layout-polygon.svg',
            'bullet' => 'dot',
            'root' => true,
            'page' => '/backend/testi',
        ],
        [
            'title' => 'Settings',
            'icon' => 'media/svg/icons/General/Settings-2.svg',
            'bullet' => 'line',
            'root' => true,
            'page' => '/settings',
            'submenu' => [
                [
                    'title' => 'Tipo Risposta',
                    'bullet' => 'dot',
                    'page' => '/backend/tiporisposta',
                ],
                [
                    'title' => 'Modelli',
                    'bullet' => 'dot',
                    'page' => '/backend/modello',
                ],
                [
                    'title' => 'Priorità',
                    'bullet' => 'dot',
                    'page' => '/backend/priorities',
                ],
                [
                    'title' => 'Flussi',
                    'bullet' => 'dot',
                    'page' => '/backend/flusso',
                ],

            ]
        ],

        // Case
        [
            'section' => 'Case',
        ],
        [
            'title' => 'Elenco Case',
            'icon' => 'media/svg/icons/Home/Library.svg',
            'bullet' => 'line',
            'root' => true,
            'page' => '/backend/casa',
        ],
        [
            'title' => 'Camere',
            'icon' => 'media/svg/icons/Home/Bed.svg',
            'bullet' => 'line',
            'root' => true,
            'page' => '/backend/camera',
        ],
        [
            'title' => 'Banche',
            'icon' => 'media/svg/icons/Shopping/Euro.svg',
            'bullet' => 'dot',
            'root' => true,
            'page' => '/backend/banca',
        ],
        [
            'title' => 'Ztl',
            'icon' => 'media/svg/icons/Tools/Road-Cone.svg',
            'bullet' => 'dot',
            'root' => true,
            'page' => '/backend/ztl',
        ],

        // Operatori
        [
            'section' => 'Operatori',
        ],
        [
            'title' => 'Elenco Operatori',
            'icon' => 'media/svg/icons/Home/Library.svg',
            'bullet' => 'line',
            'root' => true,
            'page' => '/backend/operatore',
        ],
        [
            'title' => 'Elenco Account',
            'icon' => 'media/svg/icons/General/User.svg',
            'bullet' => 'line',
            'root' => true,
            'page' => '/backend/users',
        ],

        // Varie
        [
        'section' => 'Altre Opzioni',
        ],
        [
        'title' => 'Città',
        'icon' => 'media/svg/icons/Home/Building.svg',
        'bullet' => 'line',
        'root' => true,
        'page' => '/backend/cities',
        ],
        [
            'title' => 'CityTax',
            'icon' => 'media/svg/icons/Shopping/Money.svg',
            'bullet' => 'line',
            'root' => true,
            'page' => '/backend/citytaxs',
        ],



    ],

    'items_top' => [
        [],
//        [
//            'title' => 'Prenotazioni',
//            'root' => true,
//            'page' => '/',
//            'new-tab' => false,
//        ],
//        [
//            'title' => 'Storico',
//            'root' => true,
//            'page' => '/storico',
//            'new-tab' => false,
//        ],

        /*[
            'title' => 'Pages',
            'root' => true,
            'toggle' => 'click',
            'submenu' => [
                'type' => 'mega',
                'width' => '1000px',
                'alignment' => 'center',
                'columns' => [
                    [
                        'bullet' => 'line',
                        'heading' => [
                            'heading' => true,
                            'title' => 'Pricing Tables',
                            'desc' => '',
                        ],
                        'items' => [
                            [
                                'title' => 'Pricing Tables 1',
                                'page' => 'custom/pages/pricing/pricing-1'
                            ],
                            [
                                'title' => 'Pricing Tables 2',
                                'page' => 'custom/pages/pricing/pricing-2'
                            ],
                            [
                                'title' => 'Pricing Tables 3',
                                'page' => 'custom/pages/pricing/pricing-3'
                            ],
                            [
                                'title' => 'Pricing Tables 4',
                                'page' => 'custom/pages/pricing/pricing-4'
                            ]
                        ]
                    ],
                    [
                        'bullet' => 'line',
                        'heading' => [
                            'heading' => true,
                            'title' => 'Wizards',
                            'desc' => '',
                        ],
                        'items' => [
                            [
                                'title' => 'Wizard 1',
                                'page' => 'custom/pages/wizard/wizard-1'
                            ],
                            [
                                'title' => 'Wizard 2',
                                'page' => 'custom/pages/wizard/wizard-2'
                            ],
                            [
                                'title' => 'Wizard 3',
                                'page' => 'custom/pages/wizard/wizard-3'
                            ],
                            [
                                'title' => 'Wizard 4',
                                'page' => 'custom/pages/wizard/wizard-4'
                            ]
                        ]
                    ],
                    [
                        'bullet' => 'line',
                        'heading' => [
                            'heading' => true,
                            'title' => 'Invoices & FAQ',
                            'desc' => '',
                            'bullet' => 'dot',
                        ],
                        'items' => [
                            [
                                'title' => 'Invoice 1',
                                'page' => 'custom/pages/invoices/invoice-1'
                            ],
                            [
                                'title' => 'Invoice 2',
                                'page' => 'custom/pages/invoices/invoice-2'
                            ],
                            [
                                'title' => 'FAQ 1',
                                'page' => 'custom/pages/faq/faq-1'
                            ]
                        ]
                    ],
                    [
                        'bullet' => 'line',
                        'heading' => [
                            'heading' => true,
                            'title' => 'User Pages',
                            'bullet' => 'dot',
                        ],
                        'items' => [
                            [
                                'title' => 'Login 1',
                                'page' => 'custom/pages/user/login-1',
                                'new-tab' => true
                            ],
                            [
                                'title' => 'Login 2',
                                'page' => 'custom/pages/user/login-2',
                                'new-tab' => true
                            ],
                            [
                                'title' => 'Login 3',
                                'page' => 'custom/pages/user/login-3',
                                'new-tab' => true
                            ],
                            [
                                'title' => 'Login 4',
                                'page' => 'custom/pages/user/login-4',
                                'new-tab' => true
                            ],
                            [
                                'title' => 'Login 5',
                                'page' => 'custom/pages/user/login-5',
                                'new-tab' => true
                            ],
                            [
                                'title' => 'Login 6',
                                'page' => 'custom/pages/user/login-6',
                                'new-tab' => true
                            ]
                        ]
                    ],
                    [
                        'bullet' => 'line',
                        'heading' => [
                            'heading' => true,
                            'title' => 'Error Pages',
                            'bullet' => 'dot',
                        ],
                        'items' => [
                            [
                                'title' => 'Error 1',
                                'page' => 'custom/pages/errors/error-1',
                                'new-tab' => true
                            ],
                            [
                                'title' => 'Error 2',
                                'page' => 'custom/pages/errors/error-2',
                                'new-tab' => true
                            ],
                            [
                                'title' => 'Error 3',
                                'page' => 'custom/pages/errors/error-3',
                                'new-tab' => true
                            ],
                            [
                                'title' => 'Error 4',
                                'page' => 'custom/pages/errors/error-4',
                                'new-tab' => true
                            ],
                            [
                                'title' => 'Error 5',
                                'page' => 'custom/pages/errors/error-5',
                                'new-tab' => true
                            ],
                            [
                                'title' => 'Error 6',
                                'page' => 'custom/pages/errors/error-6',
                                'new-tab' => true
                            ]
                        ]
                    ]
                ]
            ]
        ]*/
    ]

];
