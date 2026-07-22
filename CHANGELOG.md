# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Removed

- `ext_tables.sql` — no longer needed. The `tx_otcountup_item` table, including the polymorphic
  `parent_id`/`parent_table` columns used by the IRRE relation, is fully derived from TCA in TYPO3 v13+.

## [1.0.0] — 2026-07-22

### Added

- Initial version: animated, viewport-triggered CountUp content element
- IRRE-based key figures with label, start/end value, optional prefix/suffix, optional icon
- Optional icon support via `ot-icons`/`ot-iconselector` (suggest only, no hard dependency)
- Site Set `OtCountup` for auto-inclusion of TypoScript
- Counting animation (TypeScript source) with per-item `IntersectionObserver`, `prefers-reduced-motion`
  support, and accessible markup (animated value `aria-hidden`, visually hidden accessible value)
- Prefix/suffix rendered as separate, statically-styled spans next to the animated number (spacing via
  flex `gap`, only present when a prefix/suffix is actually set) — also lets the number be styled
  independently from the affixes
- Frontend rendering via TYPO3 v14's built-in `record-transformation` data processing (`{record.countup_items}`)
  — no custom DataProcessor needed
- Own minimal build (`esbuild` + `sass`) compiling TypeScript/Sass sources to pre-minified `Resources/Public`
  assets
- Grid column count (`row-cols-*`) scales automatically with the number of key figures via
  `RowColsViewHelper`, so 3, 6, or 12+ items each get a sensible layout on phone/tablet/desktop —
  only emits a breakpoint class when its value actually changes from the previous breakpoint
- TYPO3 v14.3 compatibility

[Unreleased]: https://github.com/oliverthiele/ot-countup/compare/v1.0.0...HEAD
[1.0.0]: https://github.com/oliverthiele/ot-countup/releases/tag/v1.0.0
