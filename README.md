<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## Requirements
- PHP 7.3^|8.0^
- [Composer](https://getcomposer.org/)

## Installation

- Clone the repo

```
git clone https://github.com/msbodetti/the-blog.git
```

- Install dependencies and run packages
```
cd the-blog
composer install
npm install && npm run dev
```

- Copy .env.sample and rename to .env and update env database variables
```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3310
DB_DATABASE=the-blog
DB_USERNAME=root
DB_PASSWORD=root
```

- Run migrations
```
php artisan migrate
```

- Run tests
```
php artisan test
```

You can now register an account & login :)

<img src="https://p30.f1.n0.cdn.getcloudapp.com/items/8LukR9zZ/0f19e66c-fccf-4d81-a92d-a60bf37c2ea8.gif?source=viewer&v=6f13b2cf1ea2cb11a92dbc371decf664" />

You can also start adding/editing/deleting posts :) 

<img src="https://p30.f1.n0.cdn.getcloudapp.com/items/xQunGjXx/a24f909a-e653-46fe-8798-8e98c307d415.gif?source=viewer&v=701c9bf91774db785e8e53d8108cb997" />
