# Laravel testimonials

[![Latest Version on Packagist](https://img.shields.io/packagist/v/davide-casiraghi/laravel-testimonials.svg?style=flat-square)](https://packagist.org/packages/davide-casiraghi/laravel-testimonials)
[![Build Status](https://img.shields.io/travis/davide-casiraghi/laravel-testimonials/master.svg?style=flat-square)](https://travis-ci.org/davide-casiraghi/laravel-testimonials)
[![StyleCI](https://styleci.io/repos/197168921/shield?style=flat-square)](https://styleci.io/repos/197168921)
[![Quality Score](https://img.shields.io/scrutinizer/g/davide-casiraghi/laravel-testimonials.svg?style=flat-square)](https://scrutinizer-ci.com/g/davide-casiraghi/laravel-testimonials)
[![Coverage Status](https://scrutinizer-ci.com/g/davide-casiraghi/laravel-testimonials/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/davide-casiraghi/laravel-testimonials/)
<a href="https://codeclimate.com/github/davide-casiraghi/laravel-testimonials/maintainability"><img src="https://api.codeclimate.com/v1/badges/fb6eef8ed50ad33b8f28/maintainability" /></a>
[![GitHub last commit](https://img.shields.io/github/last-commit/davide-casiraghi/laravel-testimonials.svg)](https://github.com/davide-casiraghi/laravel-testimonials) 

A Laravel package to show testimonials trough a carousel. The contents support multi language.

## Installation

You can install the package via composer:

```bash
composer require davide-casiraghi/laravel-testimonials
```

### Publish all the vendor files
```php artisan vendor:publish --force```

### Run the database migrations
```php artisan migrate```

### Install also slick carousel

```bash
npm install slick-carousel
```

### Import the scss files
Add this line to your **resources/sass/app.scss** file:  

```
@import "~slick-carousel/slick/slick";
@import "~slick-carousel/slick/slick-theme";
@import 'vendor/laravel-testimonials/testimonials';
```   

and then run in console:  
```npm run dev```  

### Import the js files
Add this line to your **resources/js/app.js** file:  
``` require('./vendor/laravel-testimonials/testimonials'); ```   
``` import 'slick-carousel'; ```

## Usage

``` php
// Usage description here
```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email davide.casiraghi@gmail.com instead of using the issue tracker.

## Credits

- [Davide Casiraghi](https://github.com/davide-casiraghi)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
