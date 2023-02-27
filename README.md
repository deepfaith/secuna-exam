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

- [L5-Swagger](https://github.com/DarkaOnLine/L5-Swagger) - A simple library to encode and decode JSON Web Tokens (JWT) in PHP, conforming to RFC 7519.
- [JWT Auth](https://github.com/tymondesigns/jwt-auth) - A simple library to encode and decode JSON Web Tokens (JWT) in PHP, conforming to RFC 7519.


### API List:
##### Authentication Module
1. [x] Register User API with Token
1. [x] Login API with Token
1. [x] Authenticated User Profile
1. [x] Refresh Data
1. [x] Logout

##### Product Module
1. [x] Product List
1. [x] Product List [Public]
1. [x] Create Product
1. [x] Edit Product
1. [x] View Product
1. [x] Delete Product

### How to Run:
1. Clone Project - 

```bash
git clone https://github.com/ManiruzzamanAkash/Laravel-Basic-CRUD-API.git
```
1. Go to the project drectory by `cd Laravel-Basic-CRUD-API` & Run the
2. Create `.env` file & Copy `.env.example` file to `.env` file
3. Create a database called - `laravel_basic_crud`.
4. Install composer packages - `composer install`.
5. Now migrate and seed database to complete whole project setup by running this-
``` bash
php artisan migrate:refresh --seed
```
It will create `21` Users and `103` Dummy Products.
6. Generate Swagger API
``` bash
php artisan l5-swagger:generate
```
7. Run the server -
``` bash
php artisan serve
```
8. Open Browser -
http://127.0.0.1:8000 & go to API Documentation -
http://127.0.0.1:8000/api/documentation
9. You'll see a Swagger Panel.


### Procedure
1. First Login with the given credential or any other user credential
1. Set bearer token to Swagger Header or Post Header as Authentication
1. Hit Any API, You can also hit any API, before authorization header data set to see the effects.


### Demo

###### API List Views:
<img src="https://i.ibb.co/gV1Yn9Z/1-Swagger-API-Demo.png" alt="1-Swagger-API-Demo" border="0">

###### Login in Swagger with Given Data:
<img src="https://i.ibb.co/5vrXkgN/2-API-Login1.png" alt="2-API-Login1" border="0">


###### Get token After Successful Login:
<img src="https://i.ibb.co/cQ37n9t/3-API-Login2-Response.png" alt="3-API-Login2-Response" border="0">

###### Set token in Swagger Header:
<img src="https://i.ibb.co/m8xQZ4T/Screenshot-2022-07-12-at-8-37-47-AM.png" alt="4-API-Swagger-Set-Bearer-Token" border="0">

###### Or, Set token in Postman Header as Authorization:
<img src="https://i.ibb.co/7p8Y3Yz/Postman-Product-List-API-with-Authenticated-Token.png" alt="Postman-Product-List-API-with-Authenticated-Token" border="0">

###### Hit Any API Route in Swagger:
<img src="https://i.ibb.co/VSWbXq9/5-API-Swaagger-Public-Product-List-View.png" alt="5-API-Swaagger-Public-Product-List-View" border="0">

###### Image Upload throw Postman:
<img src="https://i.ibb.co/VBkMBBp/Postman-Store-Product-with-File-Upload.png" alt="Postman-Store-Product-with-File-Upload" border="0">



### Test
1. Test with Postman - https://www.getpostman.com/collections/5642915d135f376b84af [Click to open with post man]
1. Test with Swagger.
1. Swagger Limitation: Image can not be uploaded throw Swagger, it can be uploaded throw Postman.
