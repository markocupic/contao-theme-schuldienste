<?php

return [
    'label'           => [
        'de' => [
            'Bilder Slider',
            'Erstellen Sie einen Bilder-Slider.',
        ],
        'en' => [
            'Image slider',
            'Create an image slider.',
        ],
    ],
    'types'           => ['content'],
    'contentCategory' => 'media',
    'standardFields'  => ['headline', 'cssID'],
    'fields'          => [
        'images' => [
            'label'        => [
                'de' => [
                    'Images',
                    'Fügen Sie eine beliebige Anzahl an Bilder ein.',
                ],
                'en' => [
                    'Members',
                    'Add any number of pictures.',
                ],
            ],
            'elementLabel' => [
                'de' => 'Bild %s',
                'en' => 'Image %s',
            ],
            'inputType'    => 'list',
            'fields'       => [
                'singleSRC' => [
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
            ],
        ],
    ],
];
