## Installation with Docker

### 1. Clone the project
```bash
git clone https://github.com/thecodeholic/laravel-social-media-website.git
```

### 2. Run `composer install`
Navigate into the project folder using Terminal and execute the following command:

```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs
```

### 3. Copy `.env.example` to `.env`

```bash
cp .env.example .env
```

### 4. Start the project in detached mode

```bash
./vendor/bin/sail up -d
```

From now on, whenever you want to run artisan commands, you should execute them from within the container. To access the Docker container:
```bash
./vendor/bin/sail bash
```

### 5. Set the encryption key

```bash
php artisan key:generate --ansi
```

### 6. Run migrations

```bash
php artisan migrate
