# X-on API Demos

This repository provides code snippets showing you examples of using the X-on API.

To use any of the API methods, you will need an API Key. To request one, please contact the X-on Support Department.

## Getting Started

These code snippets use dependencies that can be found via [Composer](https://getcomposer.org) on
[Packagist](https://packagist.org).

The examples assume that you have installed Composer, and have installed the dependencies.

```bash

# Composer installation instructions from: https://getcomposer.org/download/
# Visit the page to get the latest instructions

php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('SHA384', 'composer-setup.php') === '070854512ef404f16bac87071a6db9fd9721da1684cd4589b1196c3faf71b9a2682e2311b36a5079825e155ac7ce150d') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"


# Install dependencies

php composer.phar install

```
