<?php

echo "Running composer install...\n";
exec('composer install');

//may need to run command create .env from .env.example
//may need to run command to create database

echo "Running php artisan migrate...\n";
exec('php artisan migrate --seed');
