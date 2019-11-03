# migrator-config-wordpress
A configuration for lightscale/migrator that enabled it to work in a wordpress
theme or plugin. It provides the class `Lightscale\Migrator\Config\Wordpress`.

## Install
This should be installed from packagist with composer:
``` shell
$ composer require lightscale/migrator-config-wordpress
```

## Usage

To use it install
[Lightscale/Migrator](https://github.com/lightscaletech/migrator) into the
your plugin or themes directory.

Then create a config file `migrator_config.php` in the root of the directory.
This file needs to look something like this:

``` php
<?php

use Lightscale\Migrator\Config\Wordpress;

$config = new Wordpress('textdomain', __DIR__);
return $config->config();

```

## Reference

### Constructor

#### __construct($namespace, $base_dir, $directory = 'dbmigrations', $load_path = '../../../wp-load.php')
- $namespace (string) - is the text domain that is used to create a key in the
wp_options table.
- $base_dir (string) - is the directory that is the base of install. Relative to config. Can be __DIR__
- $directory (string) - is the directory when the migrations are stored.
- $load_path (string) - is the path to wp-load.php for initialising wordpress
with the commandline migrator tool.

### Methods

#### config()

**return** - the config array to return from the migrator_config.php file.

## Release history
- 0.0.2 Added base_dir functionality
- 0.0.1 All core functionality working. Still in on-going development.

## Requirements
- PHP 7.1.3
- Composer

## Contributors
Sam Light

## Licence
This project is licensed under the GPLv3 License - see the LICENSE file for
details.
