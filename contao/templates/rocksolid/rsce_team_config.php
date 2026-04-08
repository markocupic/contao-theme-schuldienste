<?php

return [
    'label'           => [
        'de' => [
            'Mitarbeiter',
            'Eine Liste von Personen mit Foto, Name, Telefonnummer, E-Mail-Adresse und Social-Media-Links',
        ],
        'en' => [
            'Staff',
            'A list of employees with picture, name, phone number, email and social media links',
        ],
    ],
    'types'           => ['content'],
    'contentCategory' => 'texts',
    'standardFields'  => ['headline', 'cssID'],
    'fields'          => [
        'members' => [
            'label'        => [
                'de' => [
                    'Personen',
                    'Fügen Sie eine beliebige Anzahl an Mitarbeitern ein.',
                ],
                'en' => [
                    'Members',
                    'Add any number of employees.',
                ],
            ],
            'elementLabel' => [
                'de' => 'Mitarbeiter %s',
                'en' => 'Employee %s',
            ],
            'inputType'    => 'list',
            'fields'       => [
                'image'       => [
                    'label'     => [
                        'de' => ['Profilbild', ''],
                        'en' => ['Profile picture', ''],
                    ],
                    'inputType' => 'fileTree',
                    'eval'      => [
                        'fieldType'  => 'radio',
                        'filesOnly'  => true,
                        'extensions' => 'jpg,jpeg,png,gif,svg',
                    ],
                ],
                'name'        => [
                    'label'     => [
                        'de' => ['Name', 'Vor- und Nachname des Mitarbeiters'],
                        'en' => ['Name', 'First and last name of employee'],
                    ],
                    'inputType' => 'text',
                    'eval'      => ['tl_class' => 'w50'],
                ],
                'function'    => [
                    'label'     => [
                        'de' => ['Funktion', 'Geben Sie die Funktion des Mitarbeiters an.'],
                        'en' => ['Function', 'Add the function of employee.'],
                    ],
                    'inputType' => 'text',
                    'eval'      => ['tl_class' => 'w50'],
                ],
                'description' => [
                    'label'     => [
                        'de' => ['Weitere Angaben', 'Geben Sie weitere Angaben an.'],
                        'en' => ['Further information', 'Please add some further informations.'],
                    ],
                    'inputType' => 'textarea',
                    'eval'      => ['rte' => 'tinyMCE', 'tl_class' => 'clr'],
                ],
                'phone'       => [
                    'label'     => [
                        'de' => ['Telefon', 'Telefonummer des Mitarbeiters'],
                        'en' => ['Phone', 'Phone number of employee'],
                    ],
                    'inputType' => 'text',
                    'eval'      => ['rgxp' => 'phone', 'tl_class' => 'w50'],
                ],
                'email'       => [
                    'label'     => [
                        'de' => ['E-Mail', 'E-Mail-Addresse des Mitarbeiters'],
                        'en' => ['Email', 'Email address of employee'],
                    ],
                    'inputType' => 'text',
                    'eval'      => ['rgxp' => 'email', 'tl_class' => 'w50'],
                ],
            ],
        ],
    ],
];
