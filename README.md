# katas_php

    # quick-start-kata
    mkdir string_calculator
    cd string_calculator
    cp ../tennis_scoring/*.png .
    cp ../tennis_scoring/composer.json .
    cp ../tennis_scoring/Gulpfile.js .
    cp ../tennis_scoring/phpspec.yml .
    composer install
    npm install gulp gulp-phpspec gulp-notify gulp-run gulp-plumber --save-dev
    vendor/phpspec/phpspec/bin/phpspec describe StringCalculator
