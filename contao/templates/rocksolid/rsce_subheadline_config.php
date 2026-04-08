<?php

return [
    'label'           => [
        'de' => [
            'Überschrift mit Subheadline',
            'Erstellen Sie eine Überschrift mit Subheadline.',
        ],
        'en' => [
            'Headline & Subheadline',
            'Create a headline with subheadline.',
        ],
    ],
    'types'           => ['content'],
    'contentCategory' => 'texts',
    'standardFields'  => ['headline', 'cssID'],
    'fields'          => [
        'subheadline' => [
            'label'     => [
                'de' => [
                    'Subheadline',
                    'Fügen Sie eine Subheadline ein.',
                ],
                'en' => [
                    'Subheadline',
                    'Add a subheadline.',
                ],
            ],
            'eval'      => [],
            'inputType' => 'textarea',
        ],
    ],
];
