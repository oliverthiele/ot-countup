<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'CE CountUp',
    'description' => 'TYPO3 content element for animated, viewport-triggered counting statistics (key figures).',
    'category' => 'fe',
    'author' => 'Oliver Thiele',
    'author_email' => 'mail@oliver-thiele.de',
    'author_company' => 'Web Development Oliver Thiele',
    'state' => 'stable',
    'version' => '1.0.1',
    'constraints' => [
        'depends' => [
            'typo3' => '14.3.0-14.99.99',
        ],
        'conflicts' => [],
        'suggests' => [
            'ot_icons' => '',
            'ot_iconselector' => '',
        ],
    ],
];
