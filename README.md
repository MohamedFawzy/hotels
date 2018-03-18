# Hotels
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
- `cd docker`
- `docker-compose up`
- You should see the following image
![alt text](https://raw.githubusercontent.com/MohamedFawzy/hotels/master/images/consul.png)
- Open your browser at `http://localhost:8500` you should see registered services up and running .
![alt text](https://raw.githubusercontent.com/MohamedFawzy/hotels/master/images/consul-interface.png)




# References:

- https://www.consul.io/intro/index.html
- https://www.docker.com/
