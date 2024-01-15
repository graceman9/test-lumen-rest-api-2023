This is a test task for passing an interview.

The purpose of the code was to show the Repository/Service pattern.

# Installation

1) clone repo
```
git clone https://github.com/graceman9/test-lumen-rest-api-2023.git
```

2) cd into cloned folder
```
cd test-lumen-rest-api-2023
```

3) copy .env.example to .env and **fill it with values !!**. APP_KEY and JWT_SECRET are mandatory.
```
cp .env.example .env
```

4) install composer dependencies https://laravel.com/docs/10.x/sail#installing-composer-dependencies-for-existing-projects
```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
```

5) run sail
```
./vendor/bin/sail up -d 
```

6) migrate db
```
./vendor/bin/sail artisan migrate
```

7) seed db
```
./vendor/bin/sail artisan db:seed
```

# Testing

Use test-lumen-rest-api-2023.postman_collection.json with Postman to test the REST API user and companies endpoints.
