<?php

return array(
    'label' => array(
        'de' => array(
            'Anker-Navigation',
            'Erstellen Sie eine Anker-Navigation.',
        ),
        'en' => array(
            'Anchor navigation',
            'Create an anchor navigation.',
        ),
    ),
    'types' => array('content'),
    'contentCategory' => 'links',
    'standardFields' => array('headline', 'cssID'),
    'fields' => array(
        'anchorPoints' => array(
            'label' => array(
                'de' => array(
                    'Ziel Id',
                    'Fügen Sie eine css Id an.',
                ),
                'en' => array(
                    'Target Id',
                    'Add any css id.',
                ),
            ),
            'elementLabel' => array(
                'de' => 'Ziel Element %s',
                'en' => 'Target Element %s',
            ),
            'inputType' => 'list',
            'fields' => array(
                'cssId' => array(
                    'label' => array(
                        'de' => array('CSS Id', ''),
                        'en' => array('CSS Id', ''),
                    ),
                    'inputType' => 'text',
                    'eval' => array(

                    ),
                ),
                'title' => array(
                    'label' => array(
                        'de' => array('Titel', ''),
                        'en' => array('Title', ''),
                    ),
                    'inputType' => 'text',
                    'eval' => array(

                    ),
                ),
            ),
        ),
    ),
);
