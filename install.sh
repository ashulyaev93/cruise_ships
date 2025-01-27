#!/bin/bash

echo "🚀 Установка круизного проекта..."

cp .env.example .env

if [[ "$OSTYPE" == "darwin"* ]]; then
    sed -i '' 's/DB_CONNECTION=sqlite/DB_CONNECTION=mysql/' .env
    sed -i '' 's/# DB_HOST=127.0.0.1/DB_HOST=mysql/' .env
    sed -i '' 's/# DB_PORT=3306/DB_PORT=3306/' .env
    sed -i '' 's/# DB_DATABASE=laravel/DB_DATABASE=cruise_db/' .env
    sed -i '' 's/# DB_USERNAME=root/DB_USERNAME=cruise_user/' .env
    sed -i '' 's/# DB_PASSWORD=/DB_PASSWORD=secret/' .env
    sed -i '' 's/SESSION_DRIVER=database/SESSION_DRIVER=file/' .env
    sed -i '' 's/CACHE_STORE=database/CACHE_STORE=file/' .env
    sed -i '' 's/QUEUE_CONNECTION=database/QUEUE_CONNECTION=sync/' .env

    sed -i '' 's/APP_ENV=local/APP_ENV=production/' .env
    sed -i '' 's/APP_DEBUG=true/APP_DEBUG=false/' .env
else
    sed -i 's/DB_CONNECTION=sqlite/DB_CONNECTION=mysql/' .env
    sed -i 's/# DB_HOST=127.0.0.1/DB_HOST=mysql/' .env
    sed -i 's/# DB_PORT=3306/DB_PORT=3306/' .env
    sed -i 's/# DB_DATABASE=laravel/DB_DATABASE=cruise_db/' .env
    sed -i 's/# DB_USERNAME=root/DB_USERNAME=cruise_user/' .env
    sed -i 's/# DB_PASSWORD=/DB_PASSWORD=secret/' .env
    sed -i 's/SESSION_DRIVER=database/SESSION_DRIVER=file/' .env
    sed -i 's/CACHE_STORE=database/CACHE_STORE=file/' .env
    sed -i 's/QUEUE_CONNECTION=database/QUEUE_CONNECTION=sync/' .env

    sed -i 's/APP_ENV=local/APP_ENV=production/' .env
    sed -i 's/APP_DEBUG=true/APP_DEBUG=false/' .env
fi

echo "🔧 Установка прав доступа для текущего пользователя..."
sudo chown -R $USER:$USER .

echo "🐳 Запуск Docker контейнеров..."
docker-compose up -d --build

echo "⏳ Ожидание запуска MySQL..."
sleep 15

echo "📦 Установка PHP зависимостей..."
docker-compose exec -T app composer install --no-dev --optimize-autoloader

docker-compose exec -T app php artisan key:generate

echo "🔄 Выполнение миграций..."
docker-compose exec -T app php artisan migrate:refresh --force

echo "🔗 Создание символической ссылки для хранения..."
docker-compose exec -T app php artisan storage:link

echo "💾 Импорт дампа базы данных..."
docker cp pac-dump.sql cruise_mysql:/tmp/pac-dump.sql
docker exec -i cruise_mysql bash -c "mysql -u cruise_user -psecret cruise_db < /tmp/pac-dump.sql 2>/dev/null"

echo "📦 Установка Node.js зависимостей..."
docker-compose exec -T node npm ci
echo "🔨 Сборка фронтенда..."
docker-compose exec -T node npm run build

echo "🔧 Установка прав доступа для хранения и кеша..."
docker-compose exec app chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
docker-compose exec app chmod -R 775 /var/www/storage /var/www/bootstrap/cache
docker-compose exec app chown www-data:www-data /var/www/storage/logs/laravel.log
docker-compose exec app chmod 664 /var/www/storage/logs/laravel.log

echo "⚡ Оптимизация приложения..."
docker-compose exec -T app php artisan config:cache
docker-compose exec -T app php artisan route:cache
docker-compose exec -T app php artisan view:cache

echo "🧹 Очистка неиспользуемых контейнеров..."
docker-compose stop node
docker-compose rm -f node

echo "✅ Установка завершена!"
echo "🌎 Проект доступен по адресу: http://localhost:8080/admin"
