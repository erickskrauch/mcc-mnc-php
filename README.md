# PHP database of MCC network ids

I couldn't find any existing libraries with [MCC](https://en.wikipedia.org/wiki/Mobile_country_code) identifiers map to their according country. So I made my own. The data is parsed from the [mcc-mnc.com](https://www.mcc-mnc.com) website.

A very rough implementation, but it does exactly what I needed for my job. Feel free to [open an issue](https://github.com/erickskrauch/mcc-mnc/issues/new) with your feature request. 

[![Latest Version on Packagist](https://img.shields.io/packagist/v/erickskrauch/mcc-mnc.svg?style=flat-square)](https://packagist.org/packages/erickskrauch/mcc-mnc)
[![Build Status](https://img.shields.io/github/actions/workflow/status/erickskrauch/mcc-mnc-php/ci.yml?branch=master&style=flat-square)](https://github.com/erickskrauch/mcc-mnc-php/actions)
[![Changelog](https://img.shields.io/badge/changelog-Keep%20a%20Changelog-%23E05735?style=flat-square)](CHANGELOG.md)
[![PHP version](https://img.shields.io/packagist/dependency-v/erickskrauch/mcc-mnc/php?style=flat-square)](composer.json)
[![Software License](https://img.shields.io/badge/license-MIT-green.svg?style=flat-square)](LICENSE)

## Installation

To use this library, require it in [Composer](https://getcomposer.org):

```sh
composer require erickskrauch/mcc-mnc
```

## Usage

```php
$countryCode = \ErickSkrauch\MccMnc\Reference::countryFromMcc(260); // 'PL'
$mcc = \ErickSkrauch\MccMnc\Reference::mccFromCountry('US'); // 312
```

## Contribute

This library in an Open Source under the MIT license. It is, thus, maintained by collaborators and contributors.

Feel free to contribute in any way. As an example you may:
* Trying out the `master` code.
* Create issues if you find problems.
* Reply to other people's issues.
* Review PRs.

### Ensuring code quality

The project has several tools for quality control. All checks are performed in CI, but if you want to perform checks locally, here are the necessary commands:

```sh
composer normalize
vendor/bin/php-cs-fixer fix -v
vendor/bin/phpunit
```
