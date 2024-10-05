<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# CRUD API Test Application

---

- [Required](#required)
- [Installation](#installation)
- [API Documentation](#api-documentation)

## Required

- [Laravel 10.x](https://laravel.com)
- [PHP 8.1-8.3](https://www.php.net)
- [SQLite 3](https://www.sqlite.org)

## Installation

```bash
git clone https://github.com/yar101/api_crud_test
cd api_crud_test
php artisan serve
php artisan migrate
# Соглашаемся на создание базы данных, если её нет
```
При желании можно произвести заполнение базы данных фейковыми данными с помощью команды, т.к. в проекте настроены фабрики (factories) 
```bash
php artisan db:seed
```

## API Documentation
На выбор предоставляется API документация для двух программ:

- SwaggerEditor [swagger_api.yaml](https://github.com/yar101/api_curd_test/tree/master/documentation/swagger_api.yaml) или [swagger_api.json](https://github.com/yar101/api_curd_test/tree/master/documentation/swagger_api.yaml)
- Insomnia [insomnia_api.json](https://github.com/yar101/api_curd_test/tree/master/documentation/insomnia_api.json)
