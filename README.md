git clone https://github.com/nakbill/symfony.git intelen

docker-compose up -d

docker logs  -t -f --tail 10 php


static analysis performed by phpstan vendor/bin/phpstan analyse src
