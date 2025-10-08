<?php

return [

    'pageTitle' => 'Politique de confidentialité',
    'pageSubtitle' => 'Protection et traitement de vos données personnelles',
    'lastUpdated' => 'Dernière mise à jour : :date',

    'sections' => [

        'intro' => [
            'title' => 'Introduction',
            'paragraphs' => [
                ":app s'engage à protéger votre vie privée et vos données personnelles. Cette politique explique comment nous collectons, utilisons et protégeons vos informations.",
                "En utilisant notre plateforme, vous acceptez les pratiques décrites dans cette politique de confidentialité.",
            ],
        ],

        'collection' => [
            'title' => 'Collecte des données',
            'intro' => "Nous collectons les informations suivantes pour assurer le bon fonctionnement de notre service :",
            'personalData' => [
                'title' => 'Informations personnelles',
                'items' => [
                    'Nom complet',
                    'Adresse email',
                    'Numéro de téléphone',
                    'Avatar (photo de profil)',
                    "Méthode d'inscription (email, Google, etc.)",
                    'Adresse IP et appareil de connexion',
                    "Date d'acceptation des conditions d'utilisation",
                    'Date de dernière connexion',
                ],
            ],
            'reportData' => [
                'title' => 'Données de signalement',
                'items' => [
                    'Localisation géographique des signalements',
                    'Photos et descriptions des problèmes',
                    'Date et heure des signalements',
                ],
            ],
        ],

        'usage' => [
            'title' => 'Utilisation des données',
            'intro' => 'Vos données personnelles sont utilisées exclusivement pour :',
            'items' => [
                'Traiter et suivre vos signalements',
                'Communiquer avec vous et vous informer de l\'évolution de vos signalements',
                'Améliorer le service et la sécurité de la plateforme',
            ],
        ],

        'sharing' => [
            'title' => 'Partage des données',
            'alertPart1' => 'Nous ne vendons jamais vos données personnelles',
            'alertPart2' => ' à des tiers à des fins commerciales.',
            'intro' => 'Vos données peuvent être partagées uniquement dans les cas suivants :',
            'items' => [
                'Transmission aux autorités compétentes pour le traitement des signalements',
                'Obligations légales prévues par la loi mauritanienne',
                'Prestataires techniques (hébergement, maintenance) soumis à la confidentialité',
            ],
        ],

        'security' => [
            'title' => 'Sécurité des données',
            'intro' => ":app applique des mesures de sécurité techniques et organisationnelles pour protéger vos informations :",
            'items' => [
                'Chiffrement des données en transit et au repos',
                'Accès restreint au personnel autorisé',
                'Sauvegardes régulières et sécurisées',
                'Surveillance continue contre les intrusions',
            ],
        ],

        'rights' => [
            'title' => 'Vos droits',
            'intro' => 'Vous disposez des droits suivants concernant vos données personnelles :',
            'items' => [
                'Droit d\'accès à vos données',
                'Droit de rectification ou de mise à jour',
                'Droit à l\'effacement (« droit à l\'oubli »)',
                'Droit à la portabilité des données',
            ],
        ],

        'contact' => [
            'title' => 'Contact',
            'intro' => 'Pour toute question concernant la politique de confidentialité, vous pouvez nous contacter :',
            'labelEmail' => 'Email',
            'labelAddress' => 'Adresse',
            'email' => 'privacy@sos-environnement.mr',
            'address' => 'Tevragh Zeina, Nouakchott, Mauritanie',
        ],
    ],
];
