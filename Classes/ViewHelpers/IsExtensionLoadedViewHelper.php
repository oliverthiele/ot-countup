<?php

declare(strict_types=1);

namespace OliverThiele\OtCountup\ViewHelpers;

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * Checks whether a given extension key is loaded. Used to decide, at render
 * time, which Partial to render — the actual optional-extension guard has to
 * happen via the choice of Partial (see CountUp.html), because a `<f:if>`
 * around a ViewHelper tag from a namespace that does not exist would already
 * fail at Fluid parse time, not at runtime.
 */
final class IsExtensionLoadedViewHelper extends AbstractViewHelper
{
    public function initializeArguments(): void
    {
        parent::initializeArguments();
        $this->registerArgument('extensionKey', 'string', 'Extension key to check, e.g. "ot_icons"', true);
    }

    public function render(): bool
    {
        return ExtensionManagementUtility::isLoaded((string)$this->arguments['extensionKey']);
    }
}
