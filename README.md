# Stackoverflow Api

There are two apis. First one without authentication and the other one with Sanctum authentication.

### Without Authentication

Using Postman with this urls :

#### GET

* http://locahost:8000/api/questions/php : get tagged questions, in this case tagged is equal php.

* http://localhost:8000/api/questions/php/1629650244 : get tagged questions filter by from date, in this case tagged is equal php and from date is in timestamp format.

* http://localhost:8000/api/questions/php/1629650244/1629676800 : get tagged questions filter by from date and to date, in this case tagged is equal php and from date and to date are in timestamp format.


### With Authentication

Firstly you have to create the database. For this write this command in the terminal: php artisan migrate

Next you have to register user. For this, you have to call the url http://locahost:8000/api/register by POST with the next parameters:

* name: string
* email: string
* password: string
* password_confirmation: string

If you have a registered user, you can login it calling the url http://locahost:8000/api/login by POST with the next parameters:

* email
* password

Both urls return a token. With this token you can consume the stackoverflow api with authentication.

In the next urls you have to put the bearer token in the header. The urls are:

#### GET

* http://locahost:8000/api/questions-auth/php : get tagged questions, in this case tagged is equal php.

* http://localhost:8000/api/questions-auth/php/1629650244 : get tagged questions filter by from date, in this case tagged is equal php and from date is in timestamp format.

* http://localhost:8000/api/questions-auth/php/1629650244/1629676800 : get tagged questions filter by from date and to date, in this case tagged is equal php and from date and to date are in timestamp format.

### TESTING

Write this command in terminal: .\vendor\bin\phpunit
