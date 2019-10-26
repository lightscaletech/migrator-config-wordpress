# migrator-config-wordpress
A configuration for lightscale/migrator that enabled it to work in a wordpress
theme or plugin. It provides the class `Lightscale\Migrator\Config\Wordpress`.

## Install
Currently I have not added this to packagist meaning that to install it you have
add the git repo to your `composer.json`.

``` json
    "repositories": [
        {
            "url": "https://github.com/lightscaletech/migrator-config-wordpress.git",
            "type": "vcs"
        }
    ],
    "require": {
        "lightscale/migrator-config-wordpress": "dev-master"
    }
```

Once this is added run `composer update` to install it.

I'd like to get this added to packagist but one thing at a time.

## Usage

To use it install
[Lightscale/Migrator](https://github.com/lightscaletech/migrator) into the
your plugin or themes directory.

Then create a config file `migrator_config.php` in the root of the directory.
This file needs to look something like this:

``` php
<?php

use Lightscale\Migrator\Config\Wordpress;

$config = new Wordpress('textdomain');
return $config->config();

```

## Reference

### Constructor

#### __construct($namespace, $directory = 'dbmigrations', $load_path = '../../../wp-load.php')
- $namespace (string) - is the text domain that is used to create a key in the
wp_options table.
- $directory (string) - is the directory when the migrations are stored.
- $load_path (string) - is the path to wp-load.php for initialising wordpress
with the commandline migrator tool.

### Methods

#### config()

**return** - the config array to return from the migrator_config.php file.

## Release history
- 0.0.1 All core functionality working. Still in on-going development.

## Requirements
- PHP 7.1.3
- Composer

## Contributors
Sam Light

## Licence
This project is licensed under the GPLv3 License - see the LICENSE file for
details.
