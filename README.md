# Symfony Twig Extension *CssColorFromString*

[![LICENSE](https://img.shields.io/badge/release-0.0.1-blue.svg?style=flat)](https://github.com/Fincallorca/TwigCssColorFromString/releases/tag/0.0.1)
[![Packagist](https://img.shields.io/badge/Packagist-0.0.1-blue.svg?style=flat)](https://packagist.org/packages/fincallorca/twig-css-color-from-string)
[![LICENSE](https://img.shields.io/badge/License-MIT-blue.svg?style=flat)](LICENSE)
[![https://jquery.com/](https://img.shields.io/badge/Symfony-≥3-red.svg?style=flat)](https://symfony.com/)



The **Twig CssColorFromString** bundle extends Twig with a simple filter converting strings to a css color.

## Quick Example

```html
<div class="badge" style="color: #222; background-color: {{ tag|hex }};">{{ tag }}</div>
```

The `hex` filter converts the `tag` *Standard* to the css color `#747F3F`. The output will be

```html
<div class="badge" style="color: #222; background-color: #747F3F;">Standard</div>
```

## Table of Contents

* [Integration](#getting-started)
  * [Acknowledgements](#acknowledgements)
  * [Install via Composer](#install-via-composer)
  * [Add Bundle to Symfony Application](#add-bundle-to-symfony-application)
* [Extended Usage](#extended-usage)
  * [Filter hex](#filter-hex)
  

## Getting started

### Acknowledgements

Thanks to the [stackoverflow](https://www.stackoverflow.com/) developer [Reinderien](https://meta.stackoverflow.com/users/313768/reinderien) who's
post [https://stackoverflow.com/a/3724219](https://stackoverflow.com/a/3724219) is the fundamental of this plugin. 

### Install via Composer

```bash
composer require fincallorca/twig-css-color-from-string "dev-master"
```

### Add Bundle to Symfony Application

#### Add the `CssColorFromStringBundle` to `app/AppKernel.php`

``` php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;
        
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        return [
            // [...]
            new Fincallorca\TwigExtension\CssColorFromStringBundle\CssColorFromStringBundle(),
        ];
    }
}
```


## Extended Usage

## Filter `hex`

The `hex` filter converts a string to a css color.

The same string will be converted every time in the same css color (similar like a hash value).

The optional parameter describe the **saturation** and **lightness** and can have **values
between 0 and 1**. The example below uses a `saturation` of `0.5` and a `lightness` of `0.9`.
If no parameters are submitted `0.5` is used for each parameter.

```html
<div class="badge" style="color: #222; background-color: {{ tag|hex(0.5, 0.9) }};">{{ tag }}</div>
```