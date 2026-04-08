<?php

return [
    'label'           => [
        'de' => [
            'Einzelne Addresskarte',
            'Fügen Sie dem Artikel eine Addresskarte hinzu mit, Name, Addresse, Telefonnummer und E-Mail-Adresse',
        ],
        'en' => [
            'Single address card',
            'Add an address card to the article including name, address, phone number and email address',
        ],
    ],
    'types'           => ['content'],
    'contentCategory' => 'texts',
    'standardFields'  => ['headline', 'cssID'],
    'fields'          => [
        'name'     => [
            'label'     => [
                'de' => ['Name', 'Geben Sie den Vor- und Nachnamen ein.'],
                'en' => ['Name', 'Enter the first and last name.'],
            ],
            'inputType' => 'text',
            'eval'      => ['tl_class' => 'w50'],
        ],
        'function' => [
            'label'     => [
                'de' => ['Funktion', 'Geben Sie die Funktion ein.'],
                'en' => ['Function', 'Enter the function/role.'],
            ],
            'inputType' => 'text',
            'eval'      => ['tl_class' => 'w50'],
        ],
        'street'   => [
            'label'     => [
                'de' => ['Strasse', 'Geben Sie die Strasse ein.'],
                'en' => ['Street', 'Enter the street name.'],
            ],
            'inputType' => 'text',
            'eval'      => ['rgxp' => 'extnd', 'tl_class' => 'w25'],
        ],
        'postal'   => [
            'label'     => [
                'de' => ['Postleitzahl', 'Geben Sie die Postleitzahl ein.'],
                'en' => ['Postal code', 'Enter the postal code.'],
            ],
            'inputType' => 'text',
            'eval'      => ['rgxp' => 'natural', 'tl_class' => 'w25'],
        ],
        'city'     => [
            'label'     => [
                'de' => ['Ort', 'Geben Sie den Ort ein.'],
                'en' => ['City', 'Enter the city.'],
            ],
            'inputType' => 'text',
            'eval'      => ['rgxp' => 'alpha', 'tl_class' => 'w25'],
        ],
        'phone'    => [
            'label'     => [
                'de' => ['Telefon', 'Geben Sie die Telefonnummer ein.'],
                'en' => ['Phone', 'Enter the phone number.'],
            ],
            'inputType' => 'text',
            'eval'      => ['rgxp' => 'phone', 'tl_class' => 'w50'],
        ],
        'email'    => [
            'label'     => [
                'de' => ['E-Mail', 'Geben Sie die E-Mail-Addresse ein.'],
                'en' => ['Email', 'Enter the email address.'],
            ],
            'inputType' => 'text',
            'eval'      => ['rgxp' => 'email', 'tl_class' => 'w50'],
        ],
        'url'      => [
            'label'     => [
                'de' => ['Webseite/Link', 'Geben Sie den Link- oder die Adresse der Webseite ein.'],
                'en' => ['Website/Link', 'Enter the link or website address.'],
            ],
            'inputType' => 'text',
            'eval'      => ['rgxp' => 'url', 'tl_class' => 'w50'],
        ],
    ],
];
