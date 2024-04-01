# Welcome to the Intelen project repository!

# Introduction
The project is a dockerized application which involves creating a basic CRUD application using Symfony 7 (latest version). It will manage data related to books and authors, allowing users to perform operations like adding, viewing, updating, and deleting records.

## Installation
To install and run the project locally, follow these steps:

1. Install Docker on your local machine from the official Docker website
2. Install composer dependency manager for PHP on your local machine
3. Clone the repository:  ```git clone https://github.com/nakbill/intelen.git intelen```
4. Navigate to the project directory: ```cd intelen```
5. Modify your hosts file to include ```prototype.local```
6. Run Docker containers (Without detached mode)
    - ```docker-compose up```
## Setup
1. After the containers are up and running, perform the following commands to install packages and run database migration:
   -  ```composer install```
   -  ```docker-compose exec php php bin/console make:migration --no-interaction;```
   -  ```docker-compose exec php php bin/console doctrine:migrations:migrate --no-interaction```;
2. Once the Symfony installation and migration process is completed in the PHP container is completed then access the application by browsing to ```prototype.local``` in your web browser

## Development
For static analysis using PHPStan:
- ```docker-compose exec php vendor/bin/phpstan analyse src tests -l <DESIRED_LEVEL>```
  
For running PHPUnit tests:
- ```docker-compose exec php php bin/phpunit```
