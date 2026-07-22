<?php

declare(strict_types=1);

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') or die();

call_user_func(static function () {
    ExtensionManagementUtility::addStaticFile(
        'ot_countup',
        'Configuration/TypoScript',
        'CE CountUp'
    );
});
