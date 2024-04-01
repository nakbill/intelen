# Welcome to the Intelen project repository!

# Introduction
The project is a dockerized application which involves creating a basic CRUD application using Symfony 7 (latest version). It will manage data related to books and authors, allowing users to perform operations like adding, viewing, updating, and deleting records.

## Installation
To install and run the project locally, follow these steps:

1. Clone the repository:  ```git clone https://github.com/nakbill/intelen.git intelen```
2. Navigate to the project directory: ```cd intelen```
3. Modify your hosts file to include ```prototype.local```
4. Run Docker containers (Without detached mode)
    - ```docker-compose up```
5. As soon as the containers are up and running the install the packages and the run the database migration by performing the following commands 
   -  ```docker-compose exec php composer install -n ;```
   -  ```docker-compose exec php php bin/console make:migration --no-interaction;```
   -  ```docker-compose exec php php bin/console doctrine:migrations:migrate --no-interaction```;
6. Once the Symfony installation and migration process is completed in the PHP container, 
7. Access the application by browsing to ```prototype.local``` in your web browser

## Development
For static analysis using PHPStan:
- ```docker-compose exec php vendor/bin/phpstan analyse src tests -l <DESIRED_LEVEL```
For running PHPUnit tests:
- ```docker-compose exec php php bin/phpunit```
