<?php

const ACTION_EXIT = "exit";
const ACTION_MAIN_MENU = "mainMenu";
const ACTION_BACK = "back";

$menus = [
    'options' => [
        '1' => [
            'title' => "Transfert d'argent",
            'options' => [
                'title' => "Tranférer vers : ",
                '1' => ['title' => "Orange Money"],
                '2' => ['title' => "Airtel Money"],
                '3' => ['title' => "MVola"],
                '4' => ['title' => "IZY CASH"],
                '5' => ['title' => "Banque & Microfinance"],
                '6' => ['title' => "Faire livrer du cash"],
                '00' => ACTION_MAIN_MENU,
                '0' => ACTION_BACK
            ]
        ],
        '2' => [
            'title' => "Service Orange",
            'options' => [
                'title' => "Voici nos services :",
                '1' => ['title' => "Achat Credit et offres Orange"],
                '2' => ['title' => "Bonus"],
                '3' => ['title' => "Facture Orange"],
                '4' => ['title' => "Récuperer mon numéro (avec une nouvelle carte SIM)"],
                '5' => ['title' => "Bon Plan Orange Money"],
                '00' => ACTION_MAIN_MENU,
                '0' => ACTION_BACK
            ]
        ],
        '3' => [
            'title' => "Paiements & Partenaires",
            'options' => [
                'title' => "Paiements & Partenaires :",
                '1' => ['title' => "Services partenaires"],
                '2' => ['title' => "Paiement Marchand"],
                '3' => ['title' => "Paiement en ligne"],
                '4' => ['title' => "Valider un paiement"],
                '5' => ['title' => "Paiement en agence"],
                '6' => ['title' => "Mahali"],
                '7' => ['title' => "Paiement Fournisseurs"],
                '00' => ACTION_MAIN_MENU,
                '0' => ACTION_BACK
            ]
        ],
        '4' => [
            'title' => "Services financiers",
            'options' => [
                'title' => "Services financiers :",
                '1' => ['title' => "m-kajy"],
                '2' => ['title' => "Opérations bancaires"],
                '3' => ['title' => "AccesBanque"],
                '4' => ['title' => "M-Baobab"],
                '5' => ['title' => "Service BRED Mada BP"],
                '6' => ['title' => "SIPEM Banque"],
                '7' => ['title' => "Ampio-S"],
                '00' => ACTION_MAIN_MENU,
                '0' => ACTION_BACK
            ]
        ],
        '5' => [
            'title' => "Mon compte",
            'options' => [
                'title' => "Veuillez choisir :",
                '1' => ['title' => "Gérer mon code secret"],
                '2' => ['title' => "Dernières transactions"],
                '3' => ['title' => "Solde de compte"],
                '4' => ['title' => "Langue"],
                '5' => ['title' => "Répertoire (10 contacts max)"],
                '6' => ['title' => "Infos tarifs"],
                '7' => ['title' => "Assistance"],
                '00' => ACTION_MAIN_MENU,
                '0' => ACTION_BACK
            ]
        ],
        '6' => ['title' => "Carte VISA Akory"],
        '7' => ['title' => "Compte Karama"],
        '8' => ['title' => "Retrait"],
        '#' => ACTION_EXIT
    ]
];
