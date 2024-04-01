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
    - Please note that PHP container may take some time to install all the dependencies of the project. You can monitor the progress by checking the STDOUT stream until the PHP-FPM (FastCGI Process Manager) is up and running, ready to handle connections.
5. Alternatively, you can run the Docker Compose command in detached mode by adding the -d flag:
    - ```docker-compose up -d```
    - To monitor the logs of the PHP container, you can use the following command:  ```docker logs -t -f --tail 10 php```
6. Once the Symfony installation and migration process is completed in the PHP container, you will see a message in the STDOUT stream indicating that PHP-FPM is running and ready to handle connections. ("fpm is running. ready to handle connection")
7. Access the application by browsing to ```prototype.local``` in your web browser

## Development
For static analysis using PHPStan:
- ```docker-compose exec php vendor/bin/phpstan analyse src tests -l <DESIRED_LEVEL```
For running PHPUnit tests:
- ```docker-compose exec php php bin/phpunit```
