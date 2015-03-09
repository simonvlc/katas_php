# Template directory for a phpspec kata with gulp

You can use this directory to start a new phpspec kata:

    cp _template new_kata
    cd new_kata
    composer install
    npm install gulp gulp-phpspec gulp-notify gulp-run gulp-plumber --save-dev
    vendor/phpspec/phpspec/bin/phpspec describe new_kata_class_name
    vendor/phpspec/phpspec/bin/phpspec run
    gulp

## Requirements

* composer - https://getcomposer.org/
* Node.js
* npm - https://www.npmjs.com/
* gulp - http://gulpjs.com/

## MacOs install instructions

1. Install Homebrew - http://brew.sh/

    brew install composer
    composer auto-update

    brew install nodejs
    brew install npm

    npm install -g gulp

## Running the kata

    composer install
    vendor/phpspec/phpspec/bin/phpspec run