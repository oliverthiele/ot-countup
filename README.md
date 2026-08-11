# ot_countup — Animated CountUp Content Element for TYPO3

Adds a content element with animated, viewport-triggered counting statistics (key figures) to TYPO3.

[![TYPO3](https://img.shields.io/badge/TYPO3-14.3-orange.svg)](https://typo3.org/)
[![Packagist Version](https://img.shields.io/packagist/v/oliverthiele/ot-countup.svg)](https://packagist.org/packages/oliverthiele/ot-countup)
[![PHP](https://img.shields.io/packagist/dependency-v/oliverthiele/ot-countup/php.svg)](https://php.net/)
[![License](https://img.shields.io/packagist/l/oliverthiele/ot-countup.svg)](LICENSE.txt)
[![Changelog](https://img.shields.io/badge/Changelog-CHANGELOG.md-blue.svg)](CHANGELOG.md)

## Features

- Any number of key figures per content element, managed via IRRE
- Each key figure counts up from a start to an end value once it scrolls into view
- Optional prefix/suffix per key figure (e.g. "ca.", "+", "%", "years")
- Numbers are formatted for the page language by default; per key figure the thousands separator can be
  switched off for values that are not amounts, e.g. years (1989 instead of 1,989)
- Optional icon per key figure — works standalone, or with visual icon selection when
  [`ot-iconselector`](https://packagist.org/packages/oliverthiele/ot-iconselector) is installed, and with
  rendered SVG icons when [`ot-icons`](https://packagist.org/packages/oliverthiele/ot-icons) is installed
- No hard dependency on SiteKit or any icon extension — works in any TYPO3 v14 project
- Accessible by default: animated numbers are `aria-hidden`, a visually hidden element exposes the final
  value immediately, `prefers-reduced-motion` disables the animation
- Progressive enhancement: the end value is present in the markup without JavaScript
- Ships pre-minified, dependency-free vanilla JavaScript and CSS — no build step required to use the extension

## Requirements

| Requirement | Version |
|-------------|---------|
| TYPO3       | ^14.3   |
| PHP         | >=8.4   |

## Installation

```bash
composer require oliverthiele/ot-countup
```

After installation, activate the **Site Set "OtCountup"** for your site in the TYPO3 backend.

## Configuration

### TypoScript

TypoScript is auto-included via the Site Set. For manual integration without Site Set:

```typoscript
@import 'EXT:ot_countup/Configuration/TypoScript/setup.typoscript'
```

### Optional icon support

Install [`oliverthiele/ot-iconselector`](https://packagist.org/packages/oliverthiele/ot-iconselector) for a
visual icon picker on the `icon_identifier` field, and
[`oliverthiele/ot-icons`](https://packagist.org/packages/oliverthiele/ot-icons) to render the selected icon as
inline SVG in the frontend. Both are entirely optional — without them, `icon_identifier` is a plain text field
and no icon is rendered.

### Template override

To customise the output, override the template in your sitepackage:

```typoscript
tt_content.ot_countup.templateRootPaths.10 = EXT:your_sitepackage/Resources/Private/Templates/
```

The same override mechanism can be used to swap the shipped JS/CSS for assets built by your own project's
build pipeline — see `Resources/Private/Bootstrap5/Templates/CountUp.html` for the `f:asset.*` calls to
replace.

## Usage

1. Create a new **CountUp** content element in the TYPO3 backend.
2. Add key figures via the IRRE interface. Each key figure has a label, start/end value, optional
   prefix/suffix, and an optional icon.
3. Enable **Output number without thousands separator** on a key figure whose value is not an amount —
   a year is then rendered as `1989`, not as `1,989`.
4. Optionally set the animation duration (ms) for the whole element — it applies to every key figure.

## Development

The shipped assets in `Resources/Public/JavaScript/` and `Resources/Public/Css/` are pre-built and committed.
The source lives in `Resources/Private/JavaScript/CountUp.ts` (TypeScript) and `Resources/Private/Scss/CountUp.scss`
(Sass) — the `.ts`/`.scss` extensions make it explicit that these files need compiling, unlike the portable,
build-free JS/CSS convention used elsewhere in this ecosystem. To change them:

```bash
npm install
npm run typecheck   # type-check without emitting
npm run build       # compile + minify to Resources/Public/
```

This is only needed for maintaining the extension itself — consumers do not need Node.js.

## License

GPL-2.0-or-later — © 2026 Oliver Thiele
