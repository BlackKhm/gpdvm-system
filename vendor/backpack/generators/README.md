# Backpack Generators

[![Latest Version on Packagist](https://img.shields.io/packagist/v/backpack/generators.svg?style=flat-square)](https://packagist.org/packages/backpack/generators)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/laravel-backpack/generators/master.svg?style=flat-square)](https://travis-ci.org/laravel-backpack/generators)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/laravel-backpack/generators.svg?style=flat-square)](https://scrutinizer-ci.com/g/laravel-backpack/generators/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/laravel-backpack/generators.svg?style=flat-square)](https://scrutinizer-ci.com/g/laravel-backpack/generators)
[![Style CI](https://styleci.io/repos/53490941/shield)](https://styleci.io/repos/53490941)
[![Total Downloads](https://img.shields.io/packagist/dt/backpack/generators.svg?style=flat-square)](https://packagist.org/packages/backpack/generators)

Quickly generate Backpack templated Models, Requests, Views and Config files for projects using [Backpack for Laravel](https://backpackforlaravel.com) as their admin panel.

> ### Security updates and breaking changes
> Please **[subscribe to the Backpack Newsletter](http://backpackforlaravel.com/newsletter)** so you can find out about any security updates, breaking changes or major features. We send an email every 1-2 months.

## Install

Via Composer

``` bash
composer require --dev backpack/generators 
```

## Usage

Open the console and enter one of the commands:


- **Generate Backpack\CRUD interfaces for all Eloquent models that don't already have one:**

```bash
php artisan backpack:build
```

- **Generate all files for one new Backpack\CRUD interface:**

``` bash
php artisan backpack:crud {Entity_name}

# Use singular, either PascalCase, snake_case or kebab-case.
# This will create a Model if there isn't one, or add
# our CrudTrait to the model if it already exists.
```

- Generate a new Backpack\CRUD file:
``` bash
php artisan backpack:crud-controller {Entity_name}
php artisan backpack:crud-model {Entity_name}
php artisan backpack:crud-request {Entity_name}
```

- Generate a model (available options: --softdelete)

``` bash
php artisan backpack:model {Entity_name}
```

- Generate a request

``` bash
php artisan backpack:request {Entity_name}
```

- Generate a view (available options: --plain)

``` bash
php artisan backpack:view {Entity_name}
``` 

- Generate a config file

``` bash
php artisan backpack:config {Entity_name}
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Cristian Tone](http://updivision.com)
- [Cristian Tabacitu](http://tabacitu.ro)
- [All Contributors](link-contributors)

## License

Backpack is free for non-commercial use and 69 EUR/project for commercial use. Please see [License File](LICENSE.md) and [backpackforlaravel.com](https://backpackforlaravel.com/#pricing) for more information.

## Hire us

We've spend more than 50.000 hours creating, polishing and maintaining administration panels on Laravel. We've developed e-Commerce, e-Learning, ERPs, social networks, payment gateways and much more. We've worked on admin panels _so much_, that we've created one of the most popular software in its niche - just from making public what was repetitive in our projects.

If you are looking for a developer/team to help you build an admin panel on Laravel, look no further. You'll have a difficult time finding someone with more experience & enthusiasm for this. This is _what we do_. [Contact us](https://backpackforlaravel.com/need-freelancer-or-development-team). Let's see if we can work together.
