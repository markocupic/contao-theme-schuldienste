<?php

return array(
    'label'           => array(
        'de' => array(
            'Überschrift mit Subheadline',
            'Erstellen Sie eine Überschrift mit Subheadline.',
        ),
        'en' => array(
            'Headline & Subheadline',
            'Create a headline with subheadline.',
        ),
    ),
    'types'           => array('content'),
    'contentCategory' => 'texts',
    'standardFields'  => array('headline', 'cssID'),
    'fields'          => array(
        'subheadline' => array(
            'label'     => array(
                'de' => array(
                    'Subheadline',
                    'Fügen Sie eine Subheadline ein.',
                ),
                'en' => array(
                    'Subheadline',
                    'Add a subheadline.',
                ),
            ),
            'eval'      => array(),
            'inputType' => 'textarea',
        ),
    ),

);
