# Hotels
- Hotels service

[![Build Status](https://travis-ci.org/MohamedFawzy/hotels.svg?branch=master)](https://travis-ci.org/MohamedFawzy/hotels)


[![Maintainability](https://api.codeclimate.com/v1/badges/9eb1f9c146b11e2fec8c/maintainability)](https://codeclimate.com/github/MohamedFawzy/hotels/maintainability)
# Description :
Hotels CRUD service api . 
- Consul used to register services such as php-fpm , nginx
- Link each service to service registry .
- Monitor health check and reload service if it's down .

# Perquisite
- Docker installed on your machine .


# Install
- `git clone https://github.com/MohamedFawzy/hotels.git`
- `cd hotels`
- `cd docker`
- `docker-compose up`
- You should see the following image
![alt text](https://raw.githubusercontent.com/MohamedFawzy/hotels/master/images/consul.png)
- Open your browser at `http://localhost:8500` you should see registered services up and running .
![alt text](https://raw.githubusercontent.com/MohamedFawzy/hotels/master/images/consul-interface.png)

- Open docker container for php-fpm with the following command `docker exec -it docker_microservice_hotels_fpm_1 /bin/bash`
- Install composer packages `composer install`
- copy `source/.env.example` to `.env.` change to the following
  
  ```
  DB_CONNECTION=mongodb
  
    DB_HOST=mongodb
    
    DB_PORT=27017
    
    DB_DATABASE=hotels
    
    DB_USERNAME=
    
    DB_PASSWORD=
    ```

- Open fpm container `docker exec -it docker_microservice_hotels_fpm_1 /bin/bash` 
        then 
        1- `php artisan key:generate`
        2- `php artisan config:cache`
        3- `php artisan db:seed`
        4- `./frontend.sh`
        5- `npm install`
- Use any mongo database GUI tool to access collection or login to `docker exec -it mongodb /bin/bash` then `mongo` , `use hotels`, `db.hotels.find({}).pretty()` you should see collection of documents for hotels generated by seed

# Tests:
- `docker exec -it docker_microservice_hotels_fpm_1 /bin/bash`
- `./vendor/bin/phpunit`

# Search, Filters:
1- Search can by done for range using IN with "," comma separated e.g `29-03-2018,27-04-2018`.
2- Search support IN , equal , LIKE , etc .
2- Sorting using all columns desc , asc .

# Patterns:
- Factory : hide implementation from client class
- Repository : assumed will add cache layers for filters in future so i need repository to cache query objects .
- Service layer : for calling repository and aggregate multiple repository .
- Decorator : Change object presentation in response used for filter, sort objects .
- Hydrator : Hydrate request into entity .
- Transformer: Transform response object to hotels entity .

# TODO :
1- Let GUI render multiple objects of availability .

2- Remove availability in a separate collection and aggregate it's result with hotels in Hotels Service .

3- Improve code coverage .   

# References:

- https://www.consul.io/intro/index.html
- https://www.docker.com/
