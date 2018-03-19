# Hotels
[![Build Status](https://travis-ci.org/MohamedFawzy/hotels.svg?branch=master)](https://travis-ci.org/MohamedFawzy/hotels)
Hotels service

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



# References:

- https://www.consul.io/intro/index.html
- https://www.docker.com/
