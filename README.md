# Symfony 4 CRUD


## Docker setup


1.  Install docker and docker-compose tool.

2.  Clone the docker environment repository, and inside it clone the project repository as "symfony":
    
        $: git clone https://github.com/eko/docker-symfony.git
        
        $: cd docker-symfony
        
        $: git clone https://github.com/gritt/sf4.git symfony
        
    
3.  Build and start the docker containers

        $: docker-compose build
        
        $: docker-compose up -d

4.  Enter the "symfony" dir and configure the database connection:

        $ cp .env.dist .env
        
5.  Open the .env file and update line 16 according to database password set in the docker config  

        # change from:
        DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name
        
        #to:
        DATABASE_URL=mysql://symfony:symfony@docker-symfony_db_1:3306/symfony

6.  In your local OS, add a domain entry for symfony.localhost in your /etc/hosts

        $: sudo vim /etc/hosts
        
            127.0.0.1	localhost   symfony.localhost

7.  DONE! accessing http://symfony.localhost in your browser should show Symfony's default page


## Application setup 

1.  Back in the "docker-symfony" dir, enter the application container and create the database tables running the migrations:

        $: docker exec -it docker-symfony_php_1 ash

        $: bin/console doctrine:migrations:execute

2.  Also in the application container, create some tags:

        $: bin/console add-tag Android

        $: bin/console add-tag iOS

        $: bin/console add-tag WindowsPhone

3.  DONE! you now have some tags to play around while creating products

4.  Access: http://symfony.localhost/product to start


