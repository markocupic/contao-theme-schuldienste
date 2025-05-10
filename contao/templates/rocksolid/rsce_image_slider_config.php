<?php

return array(
    'label' => array(
        'de' => array(
            'Bilder Slider',
            'Erstellen Sie einen Bilder-Slider.',
        ),
        'en' => array(
            'Image slider',
            'Create an image slider.',
        ),
    ),
    'types' => array('content'),
    'contentCategory' => 'media',
    'standardFields' => array('headline', 'cssID'),
    'fields' => array(
        'images' => array(
            'label' => array(
                'de' => array(
                    'Images',
                    'Fügen Sie eine beliebige Anzahl an Bilder ein.',
                ),
                'en' => array(
                    'Members',
                    'Add any number of pictures.',
                ),
            ),
            'elementLabel' => array(
                'de' => 'Bild %s',
                'en' => 'Image %s',
            ),
            'inputType' => 'list',
            'fields' => array(
                'singleSRC' => array(
                    'label' => array(
                        'de' => array('Profilbild', ''),
                        'en' => array('Profile picture', ''),
                    ),
                    'inputType' => 'fileTree',
                    'eval' => array(
                        'fieldType' => 'radio',
                        'filesOnly' => true,
                        'extensions' => 'jpg,jpeg,png,gif,svg',
                    ),
                ),
            ),
        ),
    ),
);
