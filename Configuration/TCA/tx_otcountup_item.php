<?php

declare(strict_types=1);

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

$ll = 'ot_countup.db:';

return [
    'ctrl' => [
        'title' => $ll . 'tx_otcountup_item.title',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'sortby' => 'sorting',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'security' => [
            'ignorePageTypeRestriction' => true,
        ],
        'searchFields' => 'title',
        'iconfile' => 'EXT:ot_countup/Resources/Public/Icons/OtCountup.svg',
    ],
    'types' => [
        '1' => [
            'showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden,
            title, --linebreak--,
            value_start, value_end, --linebreak--,
            value_unformatted, --linebreak--,
            value_prefix, value_suffix, --linebreak--,
            icon_identifier,
            --div--;frontend.ttc:tabs.access, starttime, endtime',
        ],
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => true,
            'label' => 'core.general:LGL.language',
            'config' => [
                'type' => 'language',
            ],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'label' => 'core.general:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'default' => 0,
                'items' => [
                    ['label' => '', 'value' => 0],
                ],
                'foreign_table' => 'tx_otcountup_item',
                'foreign_table_where' => 'AND {#tx_otcountup_item}.{#pid}=###CURRENT_PID### AND {#tx_otcountup_item}.{#sys_language_uid} IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'hidden' => [
            'exclude' => true,
            'label' => 'core.general:LGL.visible',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        'label' => '',
                        'invertStateDisplay' => true,
                    ],
                ],
            ],
        ],
        'starttime' => [
            'exclude' => true,
            'label' => 'core.general:LGL.starttime',
            'config' => [
                'type' => 'datetime',
                'default' => 0,
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
            ],
        ],
        'endtime' => [
            'exclude' => true,
            'label' => 'core.general:LGL.endtime',
            'config' => [
                'type' => 'datetime',
                'default' => 0,
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2038),
                ],
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
            ],
        ],
        'title' => [
            'exclude' => true,
            'label' => $ll . 'tx_otcountup_item.title',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required',
            ],
        ],
        'value_start' => [
            'exclude' => true,
            'label' => $ll . 'tx_otcountup_item.value_start',
            'description' => $ll . 'tx_otcountup_item.value_start.description',
            'config' => [
                'type' => 'number',
                'default' => 0,
                'size' => 10,
            ],
        ],
        'value_end' => [
            'exclude' => true,
            'label' => $ll . 'tx_otcountup_item.value_end',
            'config' => [
                'type' => 'number',
                'default' => 0,
                'size' => 10,
            ],
        ],
        'value_unformatted' => [
            'exclude' => true,
            'label' => $ll . 'tx_otcountup_item.value_unformatted',
            'description' => $ll . 'tx_otcountup_item.value_unformatted.description',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'default' => 0,
            ],
        ],
        'value_prefix' => [
            'exclude' => true,
            'label' => $ll . 'tx_otcountup_item.value_prefix',
            'description' => $ll . 'tx_otcountup_item.value_prefix.description',
            'config' => [
                'type' => 'input',
                'size' => 10,
                'max' => 50,
                'eval' => 'trim',
            ],
        ],
        'value_suffix' => [
            'exclude' => true,
            'label' => $ll . 'tx_otcountup_item.value_suffix',
            'description' => $ll . 'tx_otcountup_item.value_suffix.description',
            'config' => [
                'type' => 'input',
                'size' => 10,
                'max' => 50,
                'eval' => 'trim',
            ],
        ],
        'icon_identifier' => [
            'exclude' => true,
            'label' => $ll . 'tx_otcountup_item.icon_identifier',
            'config' => [
                'type' => 'input',
                'renderType' => ExtensionManagementUtility::isLoaded('ot_iconselector')
                    ? 'otIconSelector'
                    : null,
                'size' => 30,
                'max' => 40,
                'eval' => 'trim',
            ],
        ],
    ],
];
