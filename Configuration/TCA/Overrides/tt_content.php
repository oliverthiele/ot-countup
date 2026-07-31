<?php

declare(strict_types=1);

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') or die();

$extensionKey = 'ot_countup';
$ll = 'ot_countup.db:';

ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'label' => $ll . 'wizard.title',
        'value' => $extensionKey,
        'icon' => 'ot-icon-countup',
        'group' => 'extras',
        'description' => $ll . 'wizard.description',
    ],
    'textmedia',
    'after',
);

$tempColumns = [
    'countup_items' => [
        'label' => $ll . 'countup_item.label',
        'description' => $ll . 'countup_item.description',
        'config' => [
            'type' => 'inline',
            'foreign_table' => 'tx_otcountup_item',
            'foreign_field' => 'parent_id',
            'foreign_sortby' => 'sorting',
            'foreign_table_field' => 'parent_table',
            'appearance' => [
                'showSynchronizationLink' => true,
                'showAllLocalizationLink' => true,
                'showPossibleLocalizationRecords' => true,
                'collapseAll' => true,
                'useSortable' => true,
            ],
        ],
    ],
    'countup_duration' => [
        'label' => $ll . 'countup_duration',
        'description' => $ll . 'countup_duration.description',
        'config' => [
            'type' => 'number',
            'default' => 2000,
            'range' => [
                'lower' => 100,
            ],
            'size' => 10,
        ],
    ],
];

ExtensionManagementUtility::addTCAcolumns('tt_content', $tempColumns);

$GLOBALS['TCA']['tt_content']['types'][$extensionKey] = [
    'showitem' => '
    --div--;core.form.tabs:general,
        --palette--;;general,
        --palette--;;headers,
            countup_items, countup_duration,
    --div--;core.form.tabs:notes, rowDescription,',
];
