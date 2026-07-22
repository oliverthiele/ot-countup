<?php

declare(strict_types=1);

namespace OliverThiele\OtCountup\ViewHelpers;

use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * Computes Bootstrap row-cols-* classes for the key figures grid, scaled to
 * the number of items so a handful of items don't get stretched across a
 * six-column desktop grid, while larger sets still use the available width.
 * The smallest breakpoint is always single-column for readability.
 *
 * Only emits a breakpoint class when its column count actually differs from
 * the previous (smaller) breakpoint — row-cols-* rules are min-width media
 * queries, so an unchanged value already carries over without repeating it.
 */
final class RowColsViewHelper extends AbstractViewHelper
{
    /**
     * @var array<int, array{sm: int, md: int, lg: int, xl: int, xxl: int}>
     */
    private const TIERS = [
        1 => ['sm' => 1, 'md' => 1, 'lg' => 1, 'xl' => 1, 'xxl' => 1],
        2 => ['sm' => 2, 'md' => 2, 'lg' => 2, 'xl' => 2, 'xxl' => 2],
        3 => ['sm' => 2, 'md' => 3, 'lg' => 3, 'xl' => 3, 'xxl' => 3],
        4 => ['sm' => 2, 'md' => 2, 'lg' => 4, 'xl' => 4, 'xxl' => 4],
        5 => ['sm' => 2, 'md' => 3, 'lg' => 3, 'xl' => 5, 'xxl' => 5],
        6 => ['sm' => 2, 'md' => 3, 'lg' => 3, 'xl' => 3, 'xxl' => 6],
    ];

    /**
     * @var array{sm: int, md: int, lg: int, xl: int, xxl: int}
     */
    private const DEFAULT_TIER = ['sm' => 2, 'md' => 3, 'lg' => 4, 'xl' => 4, 'xxl' => 6];
    protected $escapeOutput = false;

    public function initializeArguments(): void
    {
        parent::initializeArguments();
        $this->registerArgument('count', 'int', 'Number of items in the grid', true);
    }

    public function render(): string
    {
        $count = (int)$this->arguments['count'];
        $tier = self::TIERS[$count] ?? self::DEFAULT_TIER;

        $classes = ['row-cols-1'];
        $previousColumns = 1;

        foreach ($tier as $breakpoint => $columns) {
            if ($columns !== $previousColumns) {
                $classes[] = 'row-cols-' . $breakpoint . '-' . $columns;
                $previousColumns = $columns;
            }
        }

        return implode(' ', $classes);
    }
}
