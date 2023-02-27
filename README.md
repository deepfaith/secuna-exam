# Secuna Backend API

[Laravel 9 Rest API (CRUD) ](https://github.com/deepfaith/secuna-exam)

[Project Requirements](https://drive.google.com/file/d/1t94KIVNEKFO9NQ9CoRH4gtCyZMsoliPI/view?usp=sharing)

Then application has Authentication Module, Program and Report Module. It's uses JWT authentication and Swagger API format.

----------

# Getting started

## Architecture

----------
1. Laravel 9.x
1. Interface-Repository Pattern
1. Model Based Eloquent Query
1. PHP Unit Testing - Some basic unit testing added.

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://codeigniter.com/user_guide/installation/index.html)

Clone the repository

    git clone https://github.com/deepfaith/secuna-exam.git

Switch to the repo folder

    cd secuna-exam-main

Install all the dependencies using composer

    composer update
    composer install

Modify the .env file

    cp .env.example .env

Configure Database, Environment, JWT Token (**Set the variables in .env**)

    #--------------------------------------------------------------------
    # DATABASE
    #--------------------------------------------------------------------
    
    database.default.hostname = db
    database.default.database = secuna_exam
    database.default.username = root
    database.default.password = root
    database.default.DBDriver = MySQLi

    #--------------------------------------------------------------------
    # ENVIRONMENT
    #--------------------------------------------------------------------
    
    CI_ENVIRONMENT = development

    #--------------------------------------------------------------------
    # JWT
    #--------------------------------------------------------------------
    JWT_SECRET=KjS58WvaiGjGWWMST2m9n9rlPuu66AvmpWpddd2k1EtSX6M3Vx8szt3MuLWNlt20

Run the database migrations and seeds (**Set the database connection in .env before migrating**)

    php artisan migrate:refresh --seed

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8080


**TL;DR command list**

    git clone https://github.com/deepfaith/secuna-exam.git
    cd secuna-exam-main
    composer update
    composer install
    cp .env.example .env

**Make sure you set the correct database connection information before running the migrations** [Environment variables](#Installation)

    php artisan migrate:refresh --seed

The api can be accessed at [http://localhost:8000/api](http://localhost:8000/api).

## API Specification
You can also import the postman collection used in this project thru this [link](https://github.com/deepfaith/secuna-exam/tree/main/public/Postman).

> [Full API Spec](https://github.com/deepfaith/secuna-exam/tree/main/public/Documentation)

----------

## Dependencies

- [L5-Swagger](https://github.com/DarkaOnLine/L5-Swagger) - OpenApi or Swagger Specification for your Laravel project made easy.
- [JWT Auth](https://github.com/tymondesigns/jwt-auth) - A simple library to encode and decode JSON Web Tokens (JWT) in PHP, conforming to RFC 7519.
