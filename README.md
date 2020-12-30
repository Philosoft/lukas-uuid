Based on a [question](https://symfony-devs.slack.com/archives/C3EQ7S3MJ/p1609278623462800) in a [symfony slack](https://symfony.com/slack)

#### How to use

```
git clone https://github.com/Philosoft/lukas-uuid.git
composer install
./bin/console doctrine:migrations:migrate
./bin/console app:create-product 'test product #1'
./bin/console app:create-product 'test product #2'
./bin/console app:show-product --all
```
