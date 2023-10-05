This is a test task to pass interviewing.

# Installation

1) install composer dependencies https://laravel.com/docs/10.x/sail#installing-composer-dependencies-for-existing-projects
```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
```

2) copy .env.example to .env and fill it with values

3) run sail
```
./vendor/bin/sail up -d 
```

4) migrate db
```
./vendor/bin/sail artisan migrate
```

5) seed db
```
./vendor/bin/sail artisan db:seed
```

# Testing

Use test-lumen-rest-api-2023.postman_collection.json with Postman to test the REST API user and companies endpoints.
