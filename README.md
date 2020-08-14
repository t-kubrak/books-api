# books-api
Books API

Run the following commands to spin up the docket container and install composer dependencies. 

```
docker-compose up -d --build site
docker-compose run --rm composer install
```

Postman collection to test an api could be found
[here](https://www.getpostman.com/collections/85b9e09332838ebc9224).

Note: `env` file has been added for the sake of simplicity.