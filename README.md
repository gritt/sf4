

Project Setup

    1 . git clone https://github.com/eko/docker-symfony
    
    1.2 cd, git clone this repo as ./symfony

    2 . docker-compose build

    2.1 configure /etc hosts

    3 . docker-compose up -d
        
    4 . php bin/console doctrine:migrations:migrate

    5.  fixtures

Testing with phpunit: