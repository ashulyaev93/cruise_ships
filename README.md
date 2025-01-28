# Проект: Docker + Laravel

Этот проект позволяет быстро настроить и запустить приложение на базе Laravel с использованием Docker. Следуйте инструкциям ниже для установки и запуска проекта.

## 📦 Запуск через Docker (предпочтительно)

1. **Дайте права на файл `install.sh`**  
   Для начала нужно предоставить права на выполнение скрипта `install.sh`. Введите команду:

    ```bash
    chmod +x install.sh
    ```

2. **Запустите скрипт установки**  
   Далее выполните сам скрипт установки:

    ```bash
    ./install.sh
    ```

    Скрипт выполнит все необходимые шаги для настройки проекта и установки зависимостей.
    Следуйте шагам инструкции после запуска.

    Откройте браузер и перейдите по следующему адресу для доступа к форме регистрации:

    [http://127.0.0.1:8080/admin](http://127.0.0.1:8080/admin)

## 🛠 Запуск локально

1. **Создайте `.env` файл**  
   После выполнения скрипта вам нужно создать файл `.env`, который содержит настройки для подключения к базе данных MySQL. Используйте  
   `.env.example`:

    ```bash
    cp .env.example .env
    ```

    Затем отредактируйте `.env` файл, добавив данные для подключения к MySQL (параметры `DB_HOST`, `DB_USERNAME`, `DB_PASSWORD`, `DB_DATABASE`). Выполните миграции.

    Создайте ссылку на хранилище:

    ```bash
    php artisan storage:link
    ```

2. **Выполните сборку фронтенда**  
   Выполните команду для сборки:

    ```bash
    npm run build
    ```

3. **Запустите проект**  
   Теперь вы можете запустить проект с помощью команды:

    ```bash
    php artisan serve
    ```

4. **Перейдите на форму регистрации**  
   Откройте браузер и перейдите по следующему адресу для доступа к форме регистрации:

    [http://127.0.0.1:8000/admin](http://127.0.0.1:8000/admin)
