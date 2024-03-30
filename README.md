git clone https://github.com/nakbill/symfony.git intelen

docker-compose up -d

docker logs  -t -f --tail 10 php


static analysis performed by phpstan
vendor/bin/phpstan analyse src -l 9


docker-compose exec php php bin/console make:migration
docker-compose exec php php bin/console doctrine:migrations:migrate

